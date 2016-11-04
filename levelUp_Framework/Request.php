<?php
/**
* @author Luis Vazquez
* Date : 09/07/2012
* Request Class: 	Get the url from HTACCESS
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/

class Request{

	protected $urls = array();	//declare an array
	
	public function setRequest(){
		$this->urls[] =		$_GET['get_one'];
		$this->urls[] =		$_GET['get_two'];
		$this->urls[] =		$_GET['get_three'];
		$this->urls[] =		$_GET['get_four'];
		$this->urls[] =		$_GET['get_five'];
		$this->urls[] =		$_GET['get_six'];
		
		
		//Find if is "-" and change it to underscore "_"
		for($i=0; $i < count($this->urls); $i++){
			$this->urls[$i] = str_replace(" ","-", $this->urls[$i]);
		}
		
	}
	
	/**
	* function get Urls
	*/
	public function getRequest(){
		return $this->urls;
	}
	
	
}


?>