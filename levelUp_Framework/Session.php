<?php
/**
* @author Luis Vazquez
* Date : 07/07/2011
* Session class: 	The purpose of this class is to start the session and have 
*						a log in and a log out.
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class Session{ 
	private $loged_in = false;
	private $user_id;
	private $user_nick;
	
	/**
	* Constructor
	* Start the session when we declare the object
	*/
	public function __construct(){

	}
	
	/**
	* Init session
	*/
	public function init(){
		session_start();
		$this->check_login();
	}
	
	/**
	* Checks if the user is log in or not
	*/
	public function check_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->user_nick = $_SESSION['user_nick'];
			$this->loged_in = true;
		}
		else{
			unset($_SESSION['user_id']);
			unset($_SESSION['user_nick']);
			$this->loged_in = false;
		}
	}
	
	/**
	* User login
	*/
	public function login($id, $nick){
		$this->user_id = $id;
		$this->user_nick = $nick;
		$_SESSION['user_id'] = $this->user_id;
		$_SESSION['user_nick'] = $this->user_nick;
		$this->loged_in = true;
	}
	
	/**
	* User logout
	*/
	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['user_nick']);
		unset($this->user_id);
		unset($this->user_nick);
		$this->loged_in = false;
	}
	
	/**
	* Check if the user is log in
	*/
	public function is_loged_in(){
		return $this->loged_in;
	}
	
	/**
	* Return the user id
	*/
	public function user(){
		return $this->user_id;
	}
	
	/**
	* Return the user nick
	*/
	public function user_nick(){
		return $this->user_nick;
	}

}


?>