<?php
class donate extends hf {
	public function get_content() { 
		include "engine/functions.php"; 
		if(file_exists("view/main/donate.php")) 
		{
			include "view/main/donate.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
?>
