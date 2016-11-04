<?php

class Test{
	
	private $hello;
	public function __construct(){
	
		//echo "Esto es  Test<br />";
	}
	
	public function testing(){
		echo "Esto es  Test2<br />";
	}
	
	public function setHello($hello){
		$this->hello = $hello;
	}
	
	public function getHello(){
		return $this->hello;
	}

}

?>