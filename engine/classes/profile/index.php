<?php
if(!isset($_SESSION['NickName'])) exit("<meta http-equiv='refresh' content='0; url= /profile/login'>");
else
{
class index extends hf {
	public function get_content() { 
		
		require_once ("engine/functions.php");
		checkPassword();
		if(file_exists("view/profile/index.php")) 
		{
				
			include "view/profile/index.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
}
?>
