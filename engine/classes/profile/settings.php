<?php
if(!isset($_SESSION['NickName'])) exit("<meta http-equiv='refresh' content='0; url= /profile/login'>");
else
{
class settings extends hf {
	public function get_content() { 
		
		require_once ("engine/functions.php");
		checkPassword();
		if(file_exists("view/profile/settings.php")) 
		{
				
			include "view/profile/settings.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
}
?>
