<?php
class IdController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){

		require_once("application/views/id/index_id.php");
	}
	
	public function viewAction(){
	
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

		$checkRequest = $this->request->getRequest();
		$article_id = $checkRequest[1];
		
		$article = new Article();
		
		$query = $article->select_by_id($article_id);
		
		$row = $query->fetch();
		
		$previous_row = $article->return_previous($article_id);
		$next_row = $article->return_next($article_id);

		$this->header->set_title($row['title_article']);
		//$this->header->set_property_description($this->description);
		$this->header->set_url_property("id/{$row['id_article']}/");
		//$this->header->set_tags($this->tags . " ," . $this->category);
		

		
		//If user is not logged in make sure that doesn't vote
		if(isset($user_id_button)){
			$article_button = "view_article_vote";
		}else{
			$article_button = "view_article_vote_not_logged";
		}
		
		
		///Votes
		$vote = new Votes();
		$user_id = $this->session->user();
		if( isset($user_id) ){
			if($vote->check_if_up($this->session->user(), $article_id)){
				$selected_up_button = "button_voted_up";
				$selected_up = "voted_up";
			}else{
				$selected_up_button = "";
				$selected_up = "";
			}
			
			
			if($vote->check_if_down($this->session->user(), $article_id)){
				$selected_down_button = "button_voted_down";
				$selected_down = "voted_down";
			}else{
				$selected_down_button = "";
				$selected_down = "";
			}
		}
		
		
		require_once("application/views/id/index_id.php");
	}

}
?>