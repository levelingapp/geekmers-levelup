<?php
/**
* @author Luis Vazquez
* Date : 09/27/2012
* LevelUp_Framework Class: 	The purpose of this class is to initialize all objects from framework.
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class LevelUp_Framework{

	protected $test;
	protected $session;
	protected $request;
	
	protected $thumb;
	protected $pagination;
	protected $mail;
	protected $header;
	protected $embededGames;
	protected $checkExtensions;
	
	public function __construct(){
		//Start session
		$this->session = new Session();
		$this->session->init();
		
		//open connection
		$this->connection = new Connection();
		$this->connection->open_connection();
		
		//get Parameters
		$this->request = new Request();
		$this->request->setRequest();
		
		//From this point all other classes
		$this->thumb = new Thumb();
		$this->pagination = new Pagination();
		$this->mail = new Mail();
		$this->header = new Header();
		$this->embededGames = new EmbededGames();
		$this->checkExtensions = new CheckExtensions();
		
		$this->test = new Test();
		
	}

	protected function addView($path){
		$path = "../application/views/" . $path;
		require_once($path);
	}

}

?>