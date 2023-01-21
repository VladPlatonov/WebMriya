<?php
class news extends hf {
	public function get_content() { 
		include "engine/functions.php"; 
		if(file_exists("view/main/news.php")) 
		{
			include "view/main/news.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
?>
