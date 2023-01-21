<?php
abstract class hf {	

	public function get_body() {    
		
		$this->get_content(); 
		   
	}
	abstract function get_content();
}
abstract class js {	
	public function get_body() {  
	   
		$this->get_content();
	}
	abstract function get_content();
}
?>