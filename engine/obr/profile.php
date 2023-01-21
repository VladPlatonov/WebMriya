<?php
session_start();

require_once ("../functions.php");
require_once ("../LiqPay.php");
global $db;
global $ucp_table_settings;


if($_POST['action'] == "change_password")
{
	$new_pass_1 = trim($_POST['new_password_1']);
	$new_pass_2 = trim($_POST['new_password_2']);
	if(!empty($new_pass_1) && !empty($new_pass_2))
	{
		if($new_pass_1 == $new_pass_2)
		{
			if(strlen($new_pass_1) >= 6 && strlen($new_pass_1) <= 32)//Допустимая длина пароля
			{
				if (preg_match("#^[aA-zZ0-9\-_]+$#",$new_pass_1)) //Проверка на запрещеные символы
				{ 
					if($ucp_settings['s_md5']) $pass = md5($new_pass_1);
					else $pass = $new_pass_1;
				
					$sql = "UPDATE `{$ucp_table_settings['table']}` SET `{$ucp_table_settings['pass']}` = :password_user WHERE `{$ucp_table_settings['name']}` = :user_name";
					$statement = $db->prepare($sql);
					$statement->bindParam (':password_user', $pass);
					$statement->bindParam (':user_name', $_SESSION['NickName']);
			
					$statement->execute();
					message('success','Успіх','Ви успішно змінили пароль!
		 			Перезайдіть з новим паролем','/profile/exit');

				}
				else message('warning','Помилка','Ваш пароль містить забороненні символи');	 
			}
			else message('warning','Помилка','Допустима довжина пароля від 6 до 32 символів');	
		}
		else message('warning','Помилка','Паролі не співпадають');
	}
	else message('warning','Помилка','Заповніть всі поля');
}
// if($_POST['data']!=null)
// {
// 	$liqpay = new LiqPay($this->public_key, $this->private_key);
// 	$res = $liqpay->decode_params($_POST['data']);
// 	$sql = "UPDATE `ucp_category_roulette` SET `name` = '{$name}' WHERE `u_name` = '{$res->""}'";
// 	$result = $db->query($sql, PDO::FETCH_ASSOC);
// }
if(isset($_POST["signature"]) && isset($_POST["data"]))
{ 
	$received_signature  = $_POST['signature']; 
	$received_data = $_POST['data'];  

	$private_key = 'sandbox_92iszozsz1zx68XNvLr059vlOmjwkk7K6bGExXVW'; 

	$decode_data = json_decode(base64_decode($received_data)); 
	$generated_signature = base64_encode(sha1($private_key.$received_data.$private_key, 1));

	$order_id            = $decode_data->order_id;
	$status              = $decode_data->status;
	$description         = $decode_data->description; 
	$amount              = $decode_data->amount;
	$currency            = $decode_data->currency; 
	
	
	if ($received_signature !== $generated_signature) 
	{ 
	//	file_put_contents('signature.txt', "No ident received_signature {$received_signature} generated_signature {$generated_signature}");
		die('No ident signature');
	} 
	else
	{ 
		if($status == 'success') {

			$sql = "SELECT `{$ucp_table_settings['donate']}` FROM `{$ucp_table_settings['table']}` WHERE `{$ucp_table_settings['name']}` = :name_user LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->bindParam (':name_user', $description);
			$statement->execute ();
			$data = $statement->fetch();
			$donate = $data[$ucp_table_settings['donate']]+$amount;
			$sql = "UPDATE `{$ucp_table_settings['table']}` SET `{$ucp_table_settings['donate']}` = '{$donate}' WHERE `u_name` = '$description'";
			$result = $db->query($sql, PDO::FETCH_ASSOC);
		}
	}
}	  
if($_POST['action'] == "donate")
{
    $name = trim($_POST['user_name']);
	$amount = trim($_POST['amount']);
	if(!empty($amount) && !empty($name))
	{
		$public_key = 'sandbox_i51246556517';
        $private_key = 'sandbox_92iszozsz1zx68XNvLr059vlOmjwkk7K6bGExXVW';
		$number = date("YmdHis");
		$order_id = $number;
		$liqpay = new LiqPay($this->public_key, $this->private_key);
		$data = array();
		$data['form'] = $liqpay->cnb_form(array(
			'action'         => 'pay',
			'amount'         =>  '1',
			'currency'       => 'UAH',
			'description'    => 'Mriya Donate',
			'order_id'       => "$order_id",
			'version'        => '3',
			'result_url' 	 => 'https://mriya-rp.com/'
			));
		echo $data['form'];
		// $sql = "UPDATE `ucp_category_roulette` SET `name` = '{$name}' WHERE `id` = '{$id}'";
		// $result = $db->query($sql, PDO::FETCH_ASSOC);
		// if($result) message('success','Успіх!',"Ви успішно зберегли категорію!", "/admin/roulette");
		// else message('warning','Системна Помилка!',"Нам не удалось сохранить категорию, проверьте наличие таблицы - ucp_category_roulette", "/admin/roulette");
	}
	else message('warning','Помилка!','Заповніть всі поля');	

}
if($_POST['action'] == "login") 
{
	$password = trim($_POST['user_password']);
	$name = trim($_POST['user_name']);
	// $captcha_key = trim($_POST['captcha_key']);

	if(!empty($password) && !empty($name))
	{

			$sql = "SELECT `{$ucp_table_settings['pass']}` FROM `{$ucp_table_settings['table']}` WHERE `{$ucp_table_settings['name']}` = '$name' LIMIT 1";
			// message('warning','Ошибка',$sql );	
			$statement = $db->prepare($sql);
			$statement->execute ();

			if($statement->rowCount())
			{
				$data = $statement->fetch();

			 	if($ucp_settings['s_md5']) 
				{
					if($data[$ucp_table_settings['pass']] == md5($password))
				 	{
				 		session_start();
				 		$_SESSION['NickName'] = $name;
				 		$_SESSION['Password'] = $password;
				 		
				 		message('success','Успіх','Ви успішно авторизувались!
				 		Зараз вас перенаправлять в Особистий кабінет','/profile/'); 		
				 	}	
				 	else message('warning','Помилка','Дані введені невірно виправте помилку та спробуйте знова!');
				}
				else
				{
					if($data[$ucp_table_settings['pass']] == $password)
				 	{
				 		session_start();
				 		$_SESSION['NickName'] = $name;
				 		$_SESSION['Password'] = $password;
				 		
				 		message('success','Успіх','Ви успішно авторизувались!
				 		Зараз вас перенаправлять в Особистий кабінет','/profile/'); 		
				 	}	
				 	else message('warning','Помилка','Дані введені невірно виправте помилку та спробуйте знову!');
				}
			}
			else message('warning','Помилка','Дані введені невірно');
		
			
	

	}
	else message('warning','Помилка','Заповніть всі поля');
		



}

if($_POST['action'] == "refund_item_roulette")
{
	$id = trim($_POST['id']);
	if(!empty($id))
	{
		$true_id = ($id - 1087)/147;
		$sql = "SELECT * FROM `ucp_drop_roulette` WHERE `p_number` = '$true_id' and `p_status` = '0' LIMIT 1";
		$statement = $db->prepare($sql);
		$statement->execute (); 	
		if($statement->rowCount())
		{
			$data = $statement->fetch();
			$value = $data['p_value'];
			$user = $data['p_user'];
			$sql = "UPDATE `users` set `u_donate` = `u_donate` + '25' WHERE `u_name` = '$user' LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->execute (); 
			$sql = "UPDATE `ucp_drop_roulette` set `p_status` = '1' WHERE `p_number` = '$true_id' LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->execute (); 
			message('success','','Ви успішно повернули предмет, ви отримали 25 донату! Зараз вас перенаправлять в Особистий кабінет','/profile/');
		}
		else message('warning','Системна помилка!',"Нам не вдалося повернути предмет", "/profile/");
	}

}

if($_POST['action'] == "activate_item_roulette")
{
	$id = trim($_POST['id']);
	if(!empty($id))
	{
		$true_id = ($id - 1087)/147;
		$sql = "SELECT * FROM `ucp_drop_roulette` WHERE `p_number` = '$true_id' and `p_status` = '0' LIMIT 1";
		$statement = $db->prepare($sql);
		$statement->execute (); 	
		if($statement->rowCount())
		{
			$data = $statement->fetch();
			$value = $data['p_value'];
			$user = $data['p_user'];
			switch($data['p_id'])
			{
				case 1:
    				$sql = "UPDATE `users` set `u_bank` = `u_bank` + '$value' WHERE `u_name` = '$user' LIMIT 1";
    				$statement = $db->prepare($sql);
    				$statement->execute (); 
    				$sql = "UPDATE `ucp_drop_roulette` set `p_status` = '1' WHERE `p_number` = '$true_id' LIMIT 1";
    				$statement = $db->prepare($sql);
    				$statement->execute (); 
					$sql = "INSERT INTO `money_logs` (`name`,`from_name`,`money`,`reason`,`date`) VALUES ('$user','server','$value','roulette',NOW())";
					$statement = $db->prepare($sql);
    				$statement->execute (); 
    				message('success','','Ви успішно активували предмет на ' .$value. ' віртів! Зараз вас перенаправлять в Особистий кабінет','/profile/');
					break;
			    case 2:
    				$sql = "UPDATE `users` set `u_donate` = `u_donate` + '$value' WHERE `u_name` = '$user' LIMIT 1";
    				$statement = $db->prepare($sql);
    				$statement->execute (); 
    				$sql = "UPDATE `ucp_drop_roulette` set `p_status` = '1' WHERE `p_number` = '$true_id' LIMIT 1";
    				$statement = $db->prepare($sql);
    				$statement->execute (); 
    				message('success','','Ви успішно активували предмет на ' .$value. ' донату! Зараз вас перенаправлять в Особистий кабінет','/profile/');
    				break;
				case 3:
					$sql = "INSERT INTO `roulette` (`r_car_id`,`r_status`,`r_name`) VALUES ('$value','1','$user')";
					$statement = $db->prepare($sql);
    				$statement->execute (); 
					$sql = "UPDATE `ucp_drop_roulette` set `p_status` = '1' WHERE `p_number` = '$true_id' LIMIT 1";
    				$statement = $db->prepare($sql);
    				$statement->execute (); 
    				message('success','','Ви успішно активували предмет на авто! Зараз вас перенаправлять в Особистий кабінет','/profile/');
					break;
				case 4:
					$sql = "INSERT INTO `roulette` (`r_skin`,`r_status`,`r_name`) VALUES ('$value','1','$user')";
					$statement = $db->prepare($sql);
    				$statement->execute (); 
					$sql = "UPDATE `ucp_drop_roulette` set `p_status` = '1' WHERE `p_number` = '$true_id' LIMIT 1";
    				$statement = $db->prepare($sql);
    				$statement->execute (); 
    				message('success','','Ви успішно активували предмет на скін! Зараз вас перенаправлять в Особистий кабінет','/profile/');
					break;
					break;
				case 5:
					$sql = "SELECT * FROM `users` WHERE `u_name` = '$user'  LIMIT 1";
					$statement = $db->prepare($sql);
					$statement->execute(); 
					$userdata = $statement->fetch();
					$level = $userdata['u_level'];
					$age = $userdata['u_age'];
					$exp = $userdata['u_exp'] + $value;
					$uid = $userdata['u_id'];
					if($exp >= ($level+1)*4)
					{
						$exp -= ($level+1)*4;
						$age++;
						$level++;
						if($level == 3)
						{
							$sql = "SELECT `u_id`,`u_name` FROM `users` WHERE `u_name` IN (SELECT `u_referal` FROM `users` WHERE `u_id`='$uid')";
							$statement = $db->prepare($sql);
							$statement->execute (); 
							if($statement->rowCount())
							{
								$referal = $statement->fetch();
								$referalid = $referal['u_id'];
								$sql = "INSERT INTO `debtor_message`(`dm_text`, `dm_dest`) VALUES ('Ви отримали 75.000$ за запрошення гравця $user','$referalid')";
								$statement = $db->prepare($sql);
								$statement->execute (); 
								$sql = "UPDATE `users` SET u_money=u_money+'75000' WHERE `u_id` = '$referalid'";
								$statement = $db->prepare($sql);
								$statement->execute (); 
							}
						}
					}
					$sql = "UPDATE `users` set `u_level` = '$level', `u_exp` = '$exp' , `u_age` = '$age'  WHERE `u_name` = '$user' LIMIT 1";
					$statement = $db->prepare($sql);
					$statement->execute (); 
					$sql = "UPDATE `ucp_drop_roulette` set `p_status` = '1' WHERE `p_number` = '$true_id' LIMIT 1";
					$statement = $db->prepare($sql);
					$statement->execute (); 
					message('success','','Ви успішно активували предмет на ' .$value. ' exp! Зараз вас перенаправлять в Особистий кабінет','/profile/');
				    break;
			}
		}
		else message('warning','Системна помилка!',"Нам не вдалося активувати предмет", "/profile/");
	}
	else message('warning','Системна помилка!',"Нам не вдалося активувати предмет", "/profile/");
}
if($_POST['action'] == "roulette_check_balance")
{
	$nick = $_SESSION['NickName'];
    $sql = "SELECT `{$ucp_table_settings['donate']}`,`{$ucp_table_settings['online']}` FROM `{$ucp_table_settings['table']}` WHERE `{$ucp_table_settings['name']}` = :name_user LIMIT 1";
	$statement = $db->prepare($sql);
	$statement->bindParam (':name_user', $nick);
	$statement->execute (); 
	if($statement->rowCount())
	{
		$data = $statement->fetch();
		if($data[$ucp_table_settings['online']] == 0)
		
			if($data[$ucp_table_settings['donate']] >= $ucp_settings['s_donate_cost']) echo "success";
			else echo "cash";
			
		
		else echo "online";
		
	}
	else echo "error";	

}
if($_POST['action'] == "roulette_get_item")
{
	

	$sql = "SELECT * FROM ucp_item_roulette ";
	$statement = $db->prepare($sql);
	$statement->execute ();
	$arr = [];
	if($statement->rowCount()) 
	{
			while($logs_info=$statement->fetch())
			{ 
				 $tmp = []; // инициализируем массив $tmp
	 
				   $tmp  = array('id' => $logs_info['id'],'i_name' => $logs_info['i_name'],'i_images' => $logs_info['i_images'], 'i_change' => $logs_info['i_change']);

				   $arr[] = $tmp; // в общий массив записывается
			}
	}
	echo json_encode($arr);
}

if($_POST['action'] == "roulette_get_balance") {
	 $data = GetUserData();
	echo $data[$ucp_table_settings['donate']];
	
} 
if($_POST['action'] == "roulette_generate") {

	$nick = $_SESSION['NickName'];
	$sql = "SELECT `{$ucp_table_settings['donate']}` FROM `{$ucp_table_settings['table']}` WHERE `{$ucp_table_settings['name']}` = :name_user LIMIT 1";
	$statement = $db->prepare($sql);
	$statement->bindParam (':name_user', $nick);
	$statement->execute ();
	$data = $statement->fetch();
	$donate = $data[$ucp_table_settings['donate']]-$ucp_settings['s_donate_cost'];


	$sql = "UPDATE `{$ucp_table_settings['table']}` SET `{$ucp_table_settings['donate']}` = :donate_user WHERE `{$ucp_table_settings['name']}` = :name_user LIMIT 1";
	$statement = $db->prepare($sql);
	$statement->bindParam (':donate_user', $donate);
	$statement->bindParam (':name_user', $nick);
	$statement->execute ();


	$sql = "SELECT * FROM ucp_item_roulette ";
	$statement = $db->prepare($sql);
	$statement->execute ();
	$arrs = [];
	if($statement->rowCount()) 
	{
			while($logs_info=$statement->fetch())
			{ 
				 $tmp = []; // инициализируем массив $tmp
	 
				   $tmp  = array('id' => $logs_info['id'],
				   				'i_name' => $logs_info['i_name'],
				   				'i_category' => $logs_info['i_category'],
				   				'i_images' => $logs_info['i_images'], 
				   				'i_start_rand' => $logs_info['i_start_rand'], 
				   				'i_end_rand' => $logs_info['i_end_rand'],
				   				'i_change' => $logs_info['i_change']
				   			);

				   $arrs[] = $tmp; // в общий массив записывается
			}
	}


	

 function getItem($data) {
   $randArray = array();

   foreach ($data as $value) {
     for ($i = 0; $i < $value['i_change']; $i++) { 
      $randArray[] = $value['id'];
     }
   }

   return $randArray[rand(0, count($randArray) - 1)];
 }



 	$drop = getItem($arrs);
	echo $drop;
 	for ($i = 0; $i < count($arrs); $i++) { 
       if($arrs[$i]['id'] == $drop)
       {

       if($arrs[$i]['i_start_rand'] != $arrs[$i]['i_end_rand'])
       {
       	$value = mt_rand($arrs[$i]['i_start_rand'],$arrs[$i]['i_end_rand']);
       }
       else $value = $arrs[$i]['i_start_rand'];

       $data_priz = date("d.m.Y H:i");
	    $category = $arrs[$i]['i_category'];
	    $sql = "INSERT INTO `ucp_drop_roulette`(`p_number`, `p_user`, `p_data`, `p_value`, `p_id`, `p_status`) VALUES (NULL,'{$nick}', '{$data_priz}', '{$value}', '{$category}', '0')";

 	echo $sql;
	$result = $db->query($sql, PDO::FETCH_ASSOC);


 	break;
 }

    }


    
}	
