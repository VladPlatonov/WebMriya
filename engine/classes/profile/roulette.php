<?php
if(!isset($_SESSION['NickName'])) exit("<meta http-equiv='refresh' content='0; url= /profile/login'>");
else
{
class roulette extends hf {
	public function get_content() { 
		
		require_once ("engine/functions.php");
		checkPassword();
		
		if(file_exists("view/profile/roulette.php")) 
		{
				
			include "view/profile/roulette.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
}
?>
