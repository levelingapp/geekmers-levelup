<?php

class PageController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
		
		$index = new IndexController();
		$index->indexAction();
		
		
	}
	
	public function viewAction(){
		$this->indexAction();
	}

}
?>