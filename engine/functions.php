<?php 
require_once ("config/database.php");
global $db;
global $ucp_settings;
global $ucp_table_settings;

function message($status,$header, $message, $url = '') {
	exit(json_encode(['status' => $status,'header' => $header, 'message' => $message, 'url' => $url]));
}

function location($url) {
	exit(json_encode(['url' => $url]));
}

function FixName($name)
{
	$order = array("_");
	$replace = " ";
	$newstr = str_replace($order,$replace,$name);
	$pos = strpos($newstr," ",1);
	$name = substr($newstr,0,$pos);
	$subname = substr($newstr,$pos,24);
	echo "".$name." ".$subname."";
}
function GetUserData()
{
	global $db;
	global $ucp_table_settings;

	$name = $_SESSION['NickName'];
	$sql = "SELECT * FROM `{$ucp_table_settings['table']}` WHERE `{$ucp_table_settings['name']}` = '{$name}' LIMIT 1";
		
	$statement = $db->prepare($sql);
	$statement->execute ();
	return $statement->fetch();
}
function GetOnline()
{
	global $db;
	global $ucp_table_settings;

	$sql = "SELECT * FROM `users` WHERE `u_online` != '0'";
		
	$statement = $db->prepare($sql);
	$statement->execute ();
	return $statement->rowCount();
}
function GetNameFraction($fraction)
{
	global $db;
	global $ucp_table_settings;
	$sql = "SELECT `f_name` FROM `fractions` WHERE `f_id` = '{$fraction}'";
	$statement = $db->prepare($sql);
	$statement->execute ();
	$name = $statement->fetch();
	return $name['f_name'];
}
function GetNameMember($member,$rank)
{
	global $db;
	global $ucp_table_settings;

	$sql = "SELECT `f_ranks` FROM `fractions` WHERE `f_id` = '{$member}'";	
	$statement = $db->prepare($sql);
	$statement->execute ();
	$string = $statement->fetch();
	$ranks = explode("|",$string['f_ranks']);
	return $ranks[$rank-1];
}
function getSettingColumn()
{
	global $db;
	$sql = "SELECT * FROM ucp_table_settings";

	$statement = $db->prepare($sql);
	$statement->execute ();

	while($columns = $statement->fetch())
	{
		$content .= "
		<div class=\"form-group\">
                          <label for=\"issueinput1\">Название поля | {$columns['name']}</label>
                          <input type=\"text\" id=\"issueinput1\" class=\"form-control\" value=\"{$columns['value_column']}\"
                          name=\"{$columns['name_column']}\" onChange=\"UpdateTableData(this.getAttribute('name'), this.value);\">
                        </div>

		";
	}
	return $content;
}

function getUsers() {
	global $db;

	global $ucp_table_settings;

	$sql = "SELECT {$ucp_table_settings['id']} FROM {$ucp_table_settings['table']}";

	$statement = $db->prepare($sql);

	$statement->execute ();

	return $statement->rowCount();
}
function checkPassword() {
	global $db;
	global $ucp_table_settings;
	global $ucp_settings;
	$name = $_SESSION['NickName'];
	$password = $_SESSION['Password'];

	$sql = "SELECT * FROM `{$ucp_table_settings['table']}` WHERE `{$ucp_table_settings['name']}` = '{$name}' LIMIT 1";

	$statement = $db->prepare($sql);
	$statement->execute ();

	if($statement->rowCount())
	{
		$data = $statement->fetch();
		if($ucp_settings['s_md5']) 
		{
			if($data[$ucp_table_settings['pass']] != md5($password)) exit("<meta http-equiv='refresh' content='0; url= /profile/exit'>");
		}
		else 
		{
			if($data[$ucp_table_settings['pass']] != $password) exit("<meta http-equiv='refresh' content='0; url= /profile/exit'>");
		}
	}
	else exit("<meta http-equiv='refresh' content='0; url= /profile/exit'>");

}


?>