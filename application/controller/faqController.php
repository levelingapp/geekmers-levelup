<?php
class FaqController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){

		require_once("application/views/faq/index.php");
	}

}
?>