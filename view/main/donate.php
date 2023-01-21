<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Донат - <?php echo $ucp_settings['s_title']?></title>
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/login.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>
<body class="login-page">
	<?php include "view/common/topmenu.php"; ?>

	

    <div class="heading">
        <div>
            <h1>Донат</h1>
            <div class="breaker"></div>
        </div>
        <img src="/public/main/img/dots.svg" alt="">
    </div>
	<section>
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-lg-6">
					<div class="login-block">
						<div class="container-form">
                	    <?php   
							function generatePass($length = 16)
							{
								$chars = 'qazwsxedcrfvtgbyhnujmikolpQAZWSXEDCRFVTGBYHNUJMIKOLP1234567890-_';
								$numChars = strlen($chars);
								$string = '';
							for ($i = 0; $i < $length; $i++)
								{
								$string .= substr($chars, rand(1, $numChars) - 1, 1);
								}
							return $string;
							}
							$desc = $_GET['desc']; //Можно так принять назначение платежа
							//$order_id = $_GET[‘order_id’]; //Можно так принять назначение платежа
							$price = $_GET['price'];
							$micro = generatePass(16);
							$number = date("YmdHis");
							$order_id = $number.$micro;
							$params = array(
								"public_key"     => "sandbox_i51246556517",
								'action'         => 'pay',
								'amount'         => "$price",
								'currency'       => 'UAH',
								'description'    => "$desc",
								'order_id'       => "$order_id",
								'version'        => '3',
								'language'       => 'ua',
								'result_url' 	 => 'https://mriya-rp.com/',
								'server_url'	 => 'https://mriya-rp.com/engine/obr/profile.php'

							);
							$data = base64_encode(json_encode($params));
							$private_key = 'sandbox_92iszozsz1zx68XNvLr059vlOmjwkk7K6bGExXVW';
							$str = $private_key . $data . $private_key ;
							$sign = base64_encode(sha1($str, 1));
						?>
						<?php if(isset($_GET['price'])):?>
						<form method="POST" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8">
						<input type="hidden" name="data" value="<?php echo $data ?>"/>
						<input type="hidden" name="signature" value="<?php echo $sign ?>"/>
						<div class="row justify-content-md-center mt-1">
								<div class="col-md-auto">
									<div class="form-group">
										<button class="btn " type="submit" > Купити</button>
									</div>
								</div>
							</div>
						<?php else: ?>
						<form method="GET" action="view/main/donate.php">
						<div class="form-group row">
								<label for="text" class="col-sm-4 col-form-label">Нікнейм:</label>
								<div class="col-sm-8">
									<input  type="text" name="desc" class="form-control text" placeholder="Введіть нікнейм">
								</div>
							</div>

							<div class="form-group row">
								<label for="text" class="col-sm-4 col-form-label">Сума:</label>
								<div class="col-sm-8">
									<input type="number" name="price" class="form-control text" placeholder="Введіть суму">
								</div>
							</div>
							<input type="hidden" name="action" value="donate">
							
							<div class="row justify-content-md-center mt-1">
								<div class="col-md-auto">
									<div class="form-group">
										<button class="btn " type="submit" > Купити</button>
									</div>
								</div>
							</div>
						<?php endif; ?>

						</form>
						</div>

					</div>
				</div>
				
			</div>					
		</div>
	</section>
	
	<footer class="fixed-footer">
        <?php include "view/common/footer.php"; ?>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/public/main/js/main.js" ></script>

 
</body>
</html>