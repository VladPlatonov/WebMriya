<?php
class offer extends hf {
	public function get_content() { 
		
		include "engine/functions.php"; 
		if(file_exists("view/main/offer.php")) 
		{
			include "view/main/offer.php"; 
			
		} else exit("<meta http-equiv='refresh' content='0; url= /'>");	
	}
}
?>
