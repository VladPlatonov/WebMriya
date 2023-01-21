<?php
 if(isset($_SESSION['A_Nick'])) exit("<meta http-equiv='refresh' content='0; url= /admin/'>");
 else
{
class login extends hf {
	public function get_content() { 
		
		require_once ("engine/functions.php");
		//if(!checkAdmin()) exit("<meta http-equiv='refresh' content='0; url= /profile/'>");	
		if(file_exists("view/admin/login.php")) 
		{
				
			include "view/admin/login.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
}
?>
