<!DOCTYPE html>
<html lang="ua">
<head>
	<meta charset="UTF-8">
	<title>Особистий кабінет - <?php echo $ucp_settings['s_title']?></title>
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
   
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
     <link rel="stylesheet" type="text/css" href="/public/main/css/profile.css">
    <link rel="stylesheet" type="text/css" href="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    

</head>
<body class="login-page">
	<?php include "view/common/topmenu.php"; ?>

	

    <div class="heading">
        <div>
            <h1>Особистий кабінет</h1>
            <div class="breaker"></div>
        </div>
        <img src="/public/main/img/dots.svg" alt="">
    </div>
	<?php 
	$data = GetUserData();
	$skills = explode("|",$data[$ucp_table_settings['skills']]);
	$vips = array(
		0 => "Відсутній",
		1 => "Bronze VIP",
		2 => "Silver VIP",
		3 => "Gold VIP",
	);
	?>
	<section class="profile">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 profile__container d-flex">
					<div class="profile__content">
						<div class="col-lg-4 col-sm-12">
							<div class="user__skin__content d-flex">
								<img src="/public/main/img/skins/<?php echo $data[$ucp_table_settings['skin']] ?>.png" class="user__skin__image" >
								<div class="user__name__content">
									<!-- <h1>Reiner Ghost</h1> -->
									<div class="block"><?php FixName($data[$ucp_table_settings['name']]) ?></div>
									<div class="block">#<?php echo $data[$ucp_table_settings['id']] ?></div>
								</div>
							</div>
							<div class="user__navblock__list">
								<a class="active tablinks" onclick="openTabs(event, 'stats')" id="defaultOpen"><div class="user__navblock">Статистика</div></a>
								<a class="tablinks" onclick="openTabs(event, 'skill')"><div class="user__navblock">Навички</div></a>
								<a class="tablinks" onclick="openTabs(event, 'settings')"><div class="user__navblock">Налаштування</div></a>
								<a class="tablinks" onclick="openTabs(event, 'inventory')"><div class="user__navblock">Інвентар</div></a>
								<a href="/profile/roulette"><div class="user__navblock">Рулетка</div></a>
								<a href="/profile/exit"><div class="user__navblock">Вийти</div></a>
								
							</div>
						</div>

						<div class="col-lg-8 col-sm-12">
							<div class="user__header__table">
								<table>
									<tbody>
										<tr>
											<th>Останній вхід</th>
											<th>Останній IP</th>
											<th>Стан</th>				
										</tr>
										<tr>
											<td><?php echo $data[$ucp_table_settings['last_date']] ?></td>
											<td><?php echo $data[$ucp_table_settings['last_ip']] ?></td>
											<td><?php if($data[$ucp_table_settings['online']]) echo "В грі"; else echo "Не в грі"; ?></td>				
										</tr>
									</tbody>
								</table>
							</div>


							
							<div class="user__stats tabcontent" id="stats">
								<!-- <div class="user__stats"> -->
									
									<ul class="left">
										<li>Ім'я<span><?php FixName($data[$ucp_table_settings['name']]) ?></span></li>
										<li>Рівень<span><?php echo $data[$ucp_table_settings['level']] ?></span></li>
										<li>Готівка<span><?php echo $data[$ucp_table_settings['cash']] ?>$</span></li>
										<li>Номер телефону<span><?php echo $data[$ucp_table_settings['u_phone']] ?></span></li>
										<li>Донат рахунок<span><?php echo $data[$ucp_table_settings['donate']] ?>грн.</span></li>
										<li>Банківський рахунок<span><?php echo $data[$ucp_table_settings['bank']] ?>$</span></li>
									</ul>
									<ul class="right">
										<li>Стать<span><?php if($data[$ucp_table_settings['sex']]) echo "Жіноча"; else echo "Чоловіча"; ?></span></li>
										<li>Бізнес<span><?php if($data[$ucp_table_settings['biz']] != -1) echo "#". $data[$ucp_table_settings['biz']]; else echo "Відсутній"; ?></span></li>
										<li>Будинок<span><?php if($data[$ucp_table_settings['house']] != -1) echo "#". $data[$ucp_table_settings['house']]; else echo "Відсутній"; ?></span></li>
										<li>Статус VIP<span><?php echo $vips[$data[$ucp_table_settings['vip']]] ?></span></li>
										<li>Фракція<span><?php echo GetNameFraction($data[$ucp_table_settings['member']]) ?></span></li>
										<li>Ранг<span><?php echo GetNameMember($data[$ucp_table_settings['member']],$data[$ucp_table_settings['rank']]) ?></span></li>

									</ul>
								<!-- </div> -->
							</div>
							<div class="tabcontent " id="inventory">
								<table>
									<thead>
										<tr>
											<th>Тип</th>
											<th>Дії</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$name = $_SESSION['NickName'];
									$sql = "SELECT * FROM `ucp_drop_roulette` WHERE `p_status` = '0' and `p_user` = '{$name}'";
									$statement = $db->prepare($sql);
									$statement->execute ();
									if($statement->rowCount())
									{
										while($category=$statement->fetch()) 
										{ 	
											$img = "none";	
											switch($category['p_id'])
											{
												case 1:
													$img = "/public/main/img/roulette/money.png";	
													break;
												case 2:
													$img = "/public/main/img/roulette/donate.png";
													break;
												case 3:
													$img = "/public/main/img/roulette/car{$category['p_value']}.png";
													break;
												case 4:
													$img = "/public/main/img/roulette/skin{$category['p_value']}.png";
													break;
												case 5:
													$img = "/public/main/img/roulette/time.png";
													break;
											}
											$button_code = $category['p_number'] * 147 + 1087;
											$button_activate = '<button type="button" class="btn btn-success" onclick="ActivateRouletteItem('.$button_code.');">Активувати</button>';
											$button_refund = '<button type="button" class="btn btn-danger" onclick="RefundRouletteItem('.$button_code.');">Повернути</button>';
											echo "<tr>
											<td><img src=". $img ."></td>
											<td>{$button_activate}
											{$button_refund}</td>
										  </tr>";
										} 
									}
									?>
		
									</tbody>
								</table>
							</div>
							<div class="tabcontent " id="skill">
								<div class="user__skill__gun">
									<div >
										<div class="icon"><img src="/public/main/img/sdpistol.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $skills[0] ?>%"></i></div>
										<div class="size-gun"><?php echo $skills[0] ?>%</div>
									</div>

									<div >
										<div class="icon"><img src="/public/main/img/deagle.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $skills[1] ?>%"></i></div>
										<div class="size-gun"><?php echo $skills[1] ?>%</div>
									</div>

									<div >
										<div class="icon"><img src="/public/main/img/shotgun.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $skills[2] ?>%"></i></div>
										<div class="size-gun"><?php echo $skills[2] ?>%</div>
									</div>

	                
									<div >
										<div class="icon"><img src="/public/main/img/mp5.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $skills[3] ?>%"></i></div>
										<div class="size-gun"><?php echo $skills[3] ?>%</div>
									</div>

									
									<div >
										<div class="icon"><img src="/public/main/img/ak47.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $skills[4] ?>%"></i></div>
										<div class="size-gun"><?php echo $skills[4] ?>%</div>
									</div>

									<div >
										<div class="icon"><img src="/public/main/img/m4.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $skills[5] ?>%"></i></div>
										<div class="size-gun"><?php echo $skills[5] ?>%</div>
									</div>
	                
									<div >
										<div class="icon"><img src="/public/main/img/sniper.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $skills[6] ?>%"></i></div>
										<div class="size-gun"><?php echo $skills[6] ?>%</div>
									</div>
								</div>
	                		</div>
	                		<div class="tabcontent user__settings" id="settings" style="display: none;">
								<div class="settings-block">
								<div class="container-form">
									<form method="POST" action="/engine/obr/profile.php">
										
										<div class="form-group row">
											<label for="text" class="col-sm-4 col-form-label">Новий пароль:</label>
											<div class="col-sm-8">
												<input name="new_password_1" type="text" class="form-control text" placeholder="Ввідіть новий пароль">
											</div>
										</div>

										<div class="form-group row">
											<label for="text" class="col-sm-4 col-form-label">Повтор нового пароля:</label>
											<div class="col-sm-8">
												<input name="new_password_2" type="text" class="form-control text" placeholder="Повторіть новий пароль">
											</div>
										</div>

										
										<input type="hidden" name="action" value="change_password">
										
										<div class="row justify-content-md-center mt-1">
											<div class="col-md-auto">
												<div class="form-group">
													<button class="btn btn-gradient" type="submit" > Змінити</button>
												</div>
											</div>
										</div>
								
									</div>
								</form>
							</div>
								
	                		</div>
		                	
						</div>
					</div>
				
				</div>		
			</div>			
		</div>
	</section>
	
	<footer>
        <?php include "view/common/footer.php"; ?>
    </footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="/public/main/js/form.js" ></script>
	<script src="/public/main/js/knob.js" ></script>
    <script src="/public/main/js/main.js" ></script>
    <script src="/public/main/js/profile.js" ></script>

 
</body>
</html>