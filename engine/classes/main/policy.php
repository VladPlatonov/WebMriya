<?php
class policy extends hf {
	public function get_content() { 
		
		include "engine/functions.php"; 
		if(file_exists("view/main/policy.php")) 
		{
			include "view/main/policy.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
?>
