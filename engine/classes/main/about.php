<?php
class about extends hf {
	public function get_content() { 
		
		include "engine/functions.php"; 
		if(file_exists("view/main/about.php")) 
		{
			include "view/main/about.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
?>
