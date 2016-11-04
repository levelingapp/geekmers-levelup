<?php
	
	class Votes extends Connection{
		
		private $id;
		private $vote_down;
		private $vote_up;
		private $article_id;
		private $user_id;
			
		//sql
		private $sql;
		private $query;
		private $row;
		
		
		function select_total_by_id($id){
			$this->sql = "SELECT COUNT(*) AS total FROM vote_up WHERE vote_up_article_id = :id";
			
			//Query Parameters
			$query_params = array(
				':id' => $id
			); 
			
			
			$up = 0;
			
			//$this->sql = "SELECT COUNT(*) FROM articles" ;
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
				
				$this->query_up = $stmt->fetch();
				$up = $this->query_up['total'];

			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			

			$this->sql = "SELECT COUNT(*) AS total FROM vote_down WHERE vote_down_article_id = :id";
			$down = 0;
			
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
				
				$this->query_down = $stmt->fetch();
				$down = $this->query_down['total'];
			   
				return $up - $down;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
			
			
		}
		
		
		//check if is voted up
		function check_if_up($id_user, $id_article){
			$this->sql = "SELECT * FROM vote_up WHERE vote_up_user_id = :user_id AND vote_up_article_id = :article_id";
			
			
			//Query Parameters
			$query_params = array(
				':user_id' => $id_user,
				':article_id' => $id_article
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    

				$this->row = $stmt->rowCount();
				
				if($this->row > 0){
					return true;
				}else{
					return false;
				}
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			

		}
		
		//check if is voted down
		function check_if_down($id_user, $id_article){
			$this->sql = "SELECT * FROM vote_down WHERE vote_down_user_id = :user_id AND vote_down_article_id = :article_id";
			
			//Query Parameters
			$query_params = array(
				':user_id' => $id_user,
				':article_id' => $id_article
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				$this->query = $stmt;
	
				$this->row = $stmt->rowCount();
				
				if($this->row > 0){
					return true;
				}else{
					return false;
				}
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
		//insert up
		function insert_up($user_id, $article_id){
		
			if( $this->check_if_up($user_id, $article_id) == false){
			
				$this->sql = "INSERT INTO 
							vote_up 
							(
								vote_up_article_id, 
								vote_up_user_id
							)
							VALUES (
								:article_id, 
								:user_id
							) ";

				//Query Parameters
				$query_params = array(
					':user_id' => $user_id,
					':article_id' => $article_id
				); 
				
				try {
					// Execute the query to create the user
					$stmt = parent::$db->prepare($this->sql);
					$result = $stmt->execute($query_params);
					//$last_id = $db->lastInsertId();    
					
					$this->delete_down($user_id, $article_id);
	
				}
			   
				catch(PDOException $ex) {
					// Note: On a production website, you should not output $ex->getMessage().
					// It may provide an attacker with helpful information about your code. 
					die("Failed to run query: " . $ex->getMessage());
				}

			}
			
		}
		
		
		//insert up
		function insert_down($user_id, $article_id){
		
			if( $this->check_if_down($user_id, $article_id) == false){
			
				$this->sql = "INSERT INTO 
							vote_down 
							(
								vote_down_article_id, 
								vote_down_user_id
							)
							VALUES (
								:article_id, 
								:user_id
							) ";
							
				//Query Parameters
				$query_params = array(
					':user_id' => $user_id,
					':article_id' => $article_id
				); 
				
				try {
					// Execute the query to create the user
					$stmt = parent::$db->prepare($this->sql);
					$result = $stmt->execute($query_params);
					//$last_id = $db->lastInsertId();    
					
					$this->delete_up($user_id, $article_id);
	
				}
			   
				catch(PDOException $ex) {
					// Note: On a production website, you should not output $ex->getMessage().
					// It may provide an attacker with helpful information about your code. 
					die("Failed to run query: " . $ex->getMessage());
				}	
				
			}
			
		}
		
		
		
		function delete_up($user_id, $article_id){
			$this->sql = 	"DELETE FROM vote_up
							WHERE vote_up_article_id = :article_id AND 
							vote_up_user_id = :user_id";
			
			
			//Query Parameters
			$query_params = array(
				':user_id' => $user_id,
				':article_id' => $article_id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    

			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}	
			
			
		}
		
		
		
		function delete_down($user_id, $article_id){
			$this->sql = 	"DELETE FROM vote_down
							WHERE vote_down_article_id = :article_id AND 
							vote_down_user_id = :user_id";
			
			
			//Query Parameters
			$query_params = array(
				':user_id' => $user_id,
				':article_id' => $article_id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    

			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
	}
?>