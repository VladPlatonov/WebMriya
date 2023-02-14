<?php
class terms extends hf {
	public function get_content() { 
		
		include "engine/functions.php"; 
		if(file_exists("view/main/terms.php")) 
		{
			include "view/main/terms.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
?>
