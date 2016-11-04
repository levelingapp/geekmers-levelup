<?php

class IndexController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
		
		//Articles
		$article = new Article();
		$vote = new Votes();
		
		$user_id_button = $this->session->user();
		
		//If is not safe for Work
		$user = new Users();
		if(isset($user_id_button)){
			$result_user = $user->select_by_id($user_id_button);
			$row_user = $result_user->fetch();
			$nsfw_user = $row_user['user_nsfw'];
		}else{
			$nsfw_user = "YES";
		}
		
		//Pagination
		$checkRequest = $this->request->getRequest();
		$page = $checkRequest[1];
		
		if($page ==""){
			$page = 1;
		}
		
		$per_page = 20;
		$total_count = $article->total_of_rows();
		
		$pagination = new Pagination($page, $per_page, $total_count);
	
		
		
		$article_query = $article->select_all($per_page, $pagination->offset());
		
		
		$vote = new Votes();
		
		//echo $vote->select_total_by_id(56);
		
		//If user is not logged in make sure that doesn't vote
		
		if(isset($user_id_button)){
			$article_button = "article_button";
		}else{
			$article_button = "article_button_not_logged";
		}
		
		
		//Title
		$this->header->set_title("The Best User Friendly Site For Geeks");
	
		require_once("application/views/index/home.php");
	}

}
?>