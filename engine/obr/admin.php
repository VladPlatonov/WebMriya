<?php
session_start();
require_once ("../functions.php");
global $db;


if($_POST['action'] == "go_login") 
{
	$password = trim($_POST['password']);
	$name = trim($_POST['login']);
	// $captcha_key = trim($_POST['captcha_key']);

	if(!empty($password) && !empty($name))
	{

			$sql = "SELECT `a_pass` FROM `ucp_admin` WHERE `a_admin` = '$name' LIMIT 1";
			// message('warning','Ошибка',$sql );	
			$statement = $db->prepare($sql);
			$statement->execute ();

			if($statement->rowCount())
			{
				$data = $statement->fetch();

			 	
					if($data['a_pass'] == $password)
				 	{
				 		session_start();
				 		$_SESSION['A_Nick'] = $name;
				 		//$_SESSION['Password'] = $password;
				 		
				 		message('success','Успіх','Ви успішно авторизувались!
				 		Зараз вас перенаправлять в Особистий кабінет','/admin/'); 		
				 	}	
				 	else message('warning','Помилка','Дані введені невірно виправте і спробуйте знову!');
				
			}
			else message('warning','Помилка','Дані введені невірно');
		
			
	

	}
	else message('warning','Помилка','Заповніть всі поля');
		



}

if($_POST['action'] == "update_news")
{
	$n_id = trim($_POST['n_id']);
	$n_title = trim($_POST['n_title']);
	$n_url = trim($_POST['n_url']);
	$n_text = trim($_POST['n_text']);
	$n_images = trim($_POST['n_images']);
	if(!empty($n_images) && !empty($n_text) && !empty($n_url) && !empty($n_title))
	{
		//$n_data =  date('d.m.Y'); 
		// $sql = "INSERT INTO `ucp_news` ( `n_title`, `n_text`, `n_data`, `n_images`,`n_url`) VALUES ( '{$n_title}', '{$n_text}', '{$n_data}','{$n_images}','{$n_url}')";
		$sql = "UPDATE `ucp_news` SET `n_title` = '{$n_title}',`n_text` = '{$n_text}',`n_images` = '{$n_images}',`n_url` = '{$n_url}' WHERE `n_id` = '{$n_id}'";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успіх!',"Ви успішно зберегли новину!", "/admin/news");
		else message('warning','Системна Помилка!',"Нам не вдалось зберегти новину, перевірте існування таблиці - ucp_news", "/admin/news");
	}
	else message('warning','Помилка!',"Заповніть поле");	

}
if($_POST['action'] == "delete_news")
{
	$n_id = trim($_POST['n_id']);
	if(!empty($n_id))
	{
		//$n_data =  date('d.m.Y'); 
		// $sql = "INSERT INTO `ucp_news` ( `n_title`, `n_text`, `n_data`, `n_images`,`n_url`) VALUES ( '{$n_title}', '{$n_text}', '{$n_data}','{$n_images}','{$n_url}')";
		$sql = "DELETE FROM `ucp_news` WHERE `n_id` = '{$n_id}'";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успіх!',"Ви успішно удалили новину!", "/admin/news");
		else message('warning','Системна Помилка!',"Нам не вдалось видалити новину, перевірте існування таблиці - ucp_news", "/admin/news");
	}

}
if($_POST['action'] == "delete_item_roulette")
{
	$id = trim($_POST['id']);
	if(!empty($id))
	{
		//$n_data =  date('d.m.Y'); 
		// $sql = "INSERT INTO `ucp_news` ( `n_title`, `n_text`, `n_data`, `n_images`,`n_url`) VALUES ( '{$n_title}', '{$n_text}', '{$n_data}','{$n_images}','{$n_url}')";
		$sql = "DELETE FROM `ucp_item_roulette` WHERE `id` = '{$id}'";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успіх!',"Ви успішно видалили предмет!", "/admin/roulette");
		else message('warning','Системна Ошибка!',"Нам не удалось удалить предмет, проверьте наличие таблицы - ucp_item_roulette", "/admin/roulette");
	}

}
if($_POST['action'] == "save_category_roulette")
{
	$id = trim($_POST['id']);
	$name = trim($_POST['name']);

	if(!empty($name)  && !empty($id))
	{
		//$n_data =  date('d.m.Y'); 
		// $sql = "INSERT INTO `ucp_news` ( `n_title`, `n_text`, `n_data`, `n_images`,`n_url`) VALUES ( '{$n_title}', '{$n_text}', '{$n_data}','{$n_images}','{$n_url}')";
		$sql = "UPDATE `ucp_category_roulette` SET `name` = '{$name}' WHERE `id` = '{$id}'";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успіх!',"Ви успішно зберегли категорію!", "/admin/roulette");
		else message('warning','Системна Помилка!',"Нам не удалось сохранить категорию, проверьте наличие таблицы - ucp_category_roulette", "/admin/roulette");
	}
	else message('warning','Помилка!',"Заполните поле");	

}
if($_POST['action'] == "delete_category_roulette")
{
	$id = trim($_POST['id']);
	if(!empty($id))
	{
		//$n_data =  date('d.m.Y'); 
		// $sql = "INSERT INTO `ucp_news` ( `n_title`, `n_text`, `n_data`, `n_images`,`n_url`) VALUES ( '{$n_title}', '{$n_text}', '{$n_data}','{$n_images}','{$n_url}')";
		$sql = "DELETE FROM `ucp_category_roulette` WHERE `id` = '{$id}'";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успех!',"Вы успешно удалили категорию!", "/admin/roulette");
		else message('warning','Системная Ошибка!',"Нам не удалось удалить категорию, проверьте наличие таблицы - ucp_category_roulette", "/admin/roulette");
	}

}
if($_POST['action'] == "create_category_roulette")
{
	$name = trim($_POST['category_name']);
	
	if(!empty($name))
	{
		$n_data =  date('d.m.Y'); 
		$sql = "INSERT INTO `ucp_category_roulette` ( `name`) VALUES ( '{$name}')";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успех!',"Вы успешно создали категорию!", "/admin/roulette");
		else message('warning','Системная Ошибка!',"Нам не удалось создать категорию, проверьте наличие таблицы - ucp_category_roulette", "/admin/roulette");
	}
	else message('warning','Ошибка!',"Заполните поле");	

}
if($_POST['action'] == "create_news")
{
	$n_title = trim($_POST['n_title']);
	$n_url = trim($_POST['n_url']);
	$n_text = trim($_POST['n_text']);
	$n_images = trim($_POST['n_images']);
	if(!empty($n_images) && !empty($n_text) && !empty($n_url) && !empty($n_title))
	{
		$n_data =  date('d.m.Y'); 
		$sql = "INSERT INTO `ucp_news` ( `n_title`, `n_text`, `n_data`, `n_images`,`n_url`) VALUES ( '{$n_title}', '{$n_text}', '{$n_data}','{$n_images}','{$n_url}')";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успех!',"Вы успешно создали новость!", "/admin/news");
		else message('warning','Системная Ошибка!',"Нам не удалось создать новость, проверьте наличие таблицы - ucp_news", "/admin/news");
	}
	else message('warning','Ошибка!',"Заполните поле");	

}

if($_POST['action'] == "create_item_roulette")
{
	$i_name = trim($_POST['i_name']);
	$i_images = trim($_POST['i_images']);
	$i_category = trim($_POST['i_category']);
	$i_change = trim($_POST['i_change']);
	$i_start_rand = trim($_POST['i_start_rand']);
	$i_end_rand = trim($_POST['i_end_rand']);
	if(!empty($i_name) && !empty($i_images) && !empty($i_category) && !empty($i_change) && !empty($i_start_rand) && !empty($i_end_rand))
	{
		
		$sql = "INSERT INTO `ucp_item_roulette` ( `i_name`, `i_images`, `i_category`, `i_change`,`i_start_rand`,`i_end_rand`) VALUES ( '{$i_name}', '{$i_images}', '{$i_category}','{$i_change}','{$i_start_rand}','{$i_end_rand}')";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успех!',"Вы успешно предмет в рулетку!", "/admin/roulette");
		else message('warning','Системная Ошибка!',"Нам не удалось создать предмет, проверьте наличие таблицы - ucp_item_roulette", "/admin/roulette");
	}
	else message('warning','Ошибка!',"Заполните поле");	

}
if($_POST['action'] == "save_item_roulette")
{
	$id = trim($_POST['id']);
	$i_name = trim($_POST['i_name']);
	$i_images = trim($_POST['i_images']);
	$i_category = trim($_POST['i_category']);
	$i_change = trim($_POST['i_change']);
	$i_start_rand = trim($_POST['i_start_rand']);
	$i_end_rand = trim($_POST['i_end_rand']);
	if(!empty($i_name) && !empty($i_images) && !empty($i_category) && !empty($i_change) && !empty($i_start_rand) && !empty($i_end_rand) && !empty($id))
	{
		//$n_data =  date('d.m.Y'); 
		// $sql = "INSERT INTO `ucp_news` ( `n_title`, `n_text`, `n_data`, `n_images`,`n_url`) VALUES ( '{$n_title}', '{$n_text}', '{$n_data}','{$n_images}','{$n_url}')";
		$sql = "UPDATE `ucp_item_roulette` SET `i_name` = '{$i_name}',`i_images` = '{$i_images}',`i_change` = '{$i_change}',`i_start_rand` = '{$i_start_rand}',`i_end_rand` = '{$i_end_rand}' WHERE `id` = '{$id}'";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		if($result) message('success','Успех!',"Вы успешно сохранили предмет!", "/admin/roulette");
		else message('warning','Системная Ошибка!',"Нам не удалось сохранить предмет, проверьте наличие таблицы - ucp_item_roulette", "/admin/roulette");
	}
	else message('warning','Ошибка!',"Заполните поле");	

}
if($_POST['action'] == "update_table_setting")
{
	$id = trim($_POST['id_pole']);
	$name = trim($_POST['name_pole']);
	$value = trim($_POST['value']);
	if(!empty($value))
	{
		//$sql = "UPDATE `ucp_table_settings` SET {$name} = {$value}";
		$sql = "UPDATE `ucp_table_settings` SET `value_column` = '{$value}' WHERE `name_column` = '{$name}'";
		$result = $db->query($sql, PDO::FETCH_ASSOC);
		

		if($result) message('success','Успех!',"Вы успешно обновили данные!");
		else message('warning','Системная Ошибка!',"Нам не удалось сохранить информацию, проверьте наличие таблицы - ucp_table_settings", "/admin/table");
	}
	else message('warning','Ошибка!',"Заполните поле");	

}

if($_POST['action'] == "save_settings_ucp")
{
	$s_title = trim($_POST['s_title']);
	$s_logo = trim($_POST['s_logo']);
	$s_favicon = trim($_POST['s_favicon']);
	$s_md5 = trim($_POST['s_md5']);
	$s_donate_cost = trim($_POST['s_donate_cost']);

	if(!empty($s_title) && !empty($s_logo) && !empty($s_favicon) && !empty($s_donate_cost))
	{
		$sql = "UPDATE `ucp_settings` SET `s_title` = :title,`s_favicon` = :favicon,`s_logo` = :logo,`s_md5` = :md5,`s_donate_cost` = :cost_donate";
		$statement = $db->prepare($sql);
		$statement->bindParam (':title', $s_title);
		$statement->bindParam (':favicon', $s_favicon);
		$statement->bindParam (':logo', $s_logo);
		$statement->bindParam (':md5', $s_md5);
		$statement->bindParam (':cost_donate', $s_donate_cost);
		$statement->execute();
		if($statement->rowCount()) message('success','Успех!',"Вы успешно обновили данные! Сейчас мы их обновим", "/admin/");
		else message('warning','Системная Ошибка!',"Нам не удалось сохранить информацию, проверьте наличие таблицы - ucp_settings", "/admin/");
		
			
	}
	else message('warning','Ошибка!',"Заполните все поля");	
}
