<?php
 if(!isset($_SESSION['A_Nick'])) exit("<meta http-equiv='refresh' content='0; url= /admin/login'>");
 else
{
class index extends hf {
	public function get_content() { 
		
		require_once ("engine/functions.php");
		//if(!checkAdmin()) exit("<meta http-equiv='refresh' content='0; url= /profile/'>");	
		if(file_exists("view/admin/index.php")) 
		{
			
			include "view/admin/index.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
}
?>
