<?php
class index extends hf {
	public function get_content() { 
		
		include "engine/functions.php"; 
		if(file_exists("view/main/index.php")) 
		{
			include "view/main/index.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
?>
