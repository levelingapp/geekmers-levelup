<?php
	//include Classes
	require_once("../../levelUp_Framework/Session.php");
	require_once("../../levelUp_Framework/Connection.php");
	require_once("../model/Users.php");
	
	
	//Initialize Classes
	
	//Start session
	$session = new Session();
	$session->init();

	//open connection
	$connection = new Connection();
	$connection->open_connection();
	
	$user = new Users();
	
	
	$user_id = $session->user();
	
	$nick = $_POST['nick'];
	
	$result_nick = $user->check_if_nick_exist($nick);
	
	
	
	echo  $result_nick;

?>