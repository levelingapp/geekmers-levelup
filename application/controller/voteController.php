<?php
	//include Classes
	require_once("../../levelUp_Framework/Session.php");
	require_once("../../levelUp_Framework/Connection.php");
	require_once("../model/Votes.php");
	
	
	//Initialize Classes
	
	//Start session
	$session = new Session();
	$session->init();

	//open connection
	$connection = new Connection();
	$connection->open_connection();
	
	$vote = new Votes();
	
	
	$user_id = $session->user();
	
	if(isset($user_id )){

		$article_id = $_POST['id'];
		$typeVote = $_POST['vote'];
		
		if($typeVote == "up"){
			$vote->insert_up($user_id, $article_id);
		}
		
		if($typeVote == "down"){
			$vote->insert_down($user_id, $article_id);
		}
		
		if($typeVote == "remove_up"){
			$vote->delete_up($user_id, $article_id);
		}
		
		if($typeVote == "remove_down"){
			$vote->delete_down($user_id, $article_id);
		}
		
	}

	//echo "Article id: " . $article_id;

?>