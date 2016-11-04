<?php
	
	class Article extends Connection{
		
		private $id;
		private $title;
		private $description;
		private $date;
		private $posted_by;
		private $img;
	
		private $url; 
		private $url_video; 
		private $is_video; 
		private $nsfw; 
		private $url_source; 
		private $is_banned;
			
		//sql
		private $sql;
		private $query;
		private $row;
		
		
		//********************************************************************************
		// SELECT ALL
		//********************************************************************************
		public function select_all($page = NULL, $offset = NULL){
			$this->sql = "SELECT * FROM articles 
			JOIN users ON articles.posted_by_article = users.user_id
			ORDER BY articles.posted_on_article DESC";
			
			if($page != NULL )
			{
				$this->sql .= " LIMIT {$page} OFFSET {$offset}";
			}
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute();
				//$last_id = $db->lastInsertId();    

			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
		}
		
		
		//********************************************************************************
		// SELECT ALL post by user
		//********************************************************************************
		public function select_all_by_user($id, $page = NULL, $offset = NULL){
			$this->id = $id;
			$this->sql = "SELECT *
						FROM articles
						WHERE articles.posted_by_article = :id
						ORDER BY articles.posted_on_article DESC";
			
			if($page != NULL )
			{
				$this->sql .= " LIMIT {$page} OFFSET {$offset}";
			}
			
			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			

		}
		
		//********************************************************************************
		//	Return the number of rows
		//********************************************************************************
		public function total_of_rows(){
			$this->sql = "SELECT COUNT(*) AS total FROM articles" ;

			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute();
				//$last_id = $db->lastInsertId();    
				
				$total = $stmt->fetch();
			   
				return $total['total'];
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());

			}
		}
		
		//********************************************************************************
		//	Select by id
		//	INNER JOIN usuarios on articles.who_article = usuarios.id_user 
		//********************************************************************************
		public function select_by_id($id){
			$this->id = $id;
			$this->sql = "SELECT user_id, user_fname, user_lname, user_nick, user_email, user_dob, user_gender, title_article, description_article, url_article, url_video_article, is_video_article, 
			img_original_article, img_wall_article, img_thumb_article, nsfw_article, url_source_article, posted_by_article, posted_on_article, is_banned_article
			FROM articles
			JOIN users ON articles.posted_by_article = users.user_id
			WHERE articles.id_article = :id";
			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
		
		//********************************************************************************
		//	Select by id
		//	INNER JOIN usuarios on articles.who_article = usuarios.id_user 
		//********************************************************************************
		public function select_by_user_id($id){
			$this->id = $id;
			$this->sql = "SELECT * FROM articles 
			WHERE articles.id_article = :id
			ORDER BY articles.posted_on_articles DESC";
			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
		//********************************************************************************
		//	ADD (insert a new row in articles)
		//********************************************************************************
		public function insert($form, $posted_by, $img){
			$this->title = $form['title'];
			$this->description = trim($form['description']);
			$this->date = date('Y-m-d H:i:s');
			$this->posted_by = $posted_by;
			$this->url = $form['url'];
			$this->url_video = $form['urlVideo']; 
			$this->url_source = $form['sourceUrl'];
			$this->is_banned = "NO";

			
			if($form["type_of_upload"] == "on"){
				$this->is_video = "YES";
			}
			else{
				$this->is_video = "NO";
			}
			
			//NSFW
			if($form["NSFW"] == "on"){
				$this->nsfw = "YES";
			}
			else{
				$this->nsfw = "NO";
			}
			
			
			//$this->img;
			$this->sql = 	"INSERT INTO 
							articles 
							(
								title_article, 
								description_article, 
								url_article, 
								url_video_article, 
								is_video_article,
								img_original_article, 
								img_wall_article, 
								img_thumb_article, 
								nsfw_article, 
								url_source_article, 
								posted_by_article, 
								posted_on_article,
								is_banned_article
							)
							VALUES (
							:title, 
							:description, 
							:url, 
							:url_video, 
							:is_video, 
							:original, 
							:wall, 
							:thumb, 
							:nsfw, 
							:url_source, 
							:posted_by,
							:date,
							:is_banned
							)";
							
			//Query Parameters
			$query_params = array(
				"title" => $this->title, 
				"description" => $this->description, 
				"url" => $this->url, 
				"url_video" => $this->url_video, 
				"is_video" => $this->is_video, 
				"original" => $img['original'], 
				"wall" => $img['wall'], 
				"thumb" => $img['thumb'], 
				"nsfw" => $this->nsfw, 
				"url_source" => $this->url_source, 
				"posted_by" => $this->posted_by,
				"date" => $this->date,
				"is_banned" => $this->is_banned
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				$last_id = parent::$db->lastInsertId(); 
				return $last_id;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		
		}



		//********************************************************************************
		//	ADD (insert a new row in articles)
		//********************************************************************************
		public function insert_videos($form, $posted_by, $img = null){
			$this->title = $form['title'];
			$this->description = trim($form['description']);
			$this->date = date('Y-m-d H:i:s');
			$this->posted_by = $posted_by;
			$this->url_video = $form['urlVideo']; 
			$this->url_source = $form['sourceUrl'];
			$this->is_banned = "NO";

			$this->is_video = "YES";

			
			//NSFW
			if($form["NSFW"] == "on"){
				$this->nsfw = "YES";
			}
			else{
				$this->nsfw = "NO";
			}
			
			
			//$this->img;
			$this->sql = 	"INSERT INTO 
							articles 
							(
								title_article, 
								description_article, 
								url_article, 
								url_video_article, 
								is_video_article,
								nsfw_article, 
								url_source_article, 
								posted_by_article, 
								posted_on_article,
								is_banned_article
							)
							VALUES (
							:title, 
							:description, 
							:url, 
							:url_video, 
							:is_video, 
							:nsfw, 
							:url_source, 
							:posted_by,
							:date,
							:is_banned
							)";
							
			//Query Parameters
			$query_params = array(
				"title" => $this->title, 
				"description" => $this->description, 
				"url" => $this->url, 
				"url_video" => $this->url_video, 
				"is_video" => $this->is_video, 
				"nsfw" => $this->nsfw, 
				"url_source" => $this->url_source, 
				"posted_by" => $this->posted_by,
				"date" => $this->date,
				"is_banned" => $this->is_banned
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				$last_id = parent::$db->lastInsertId(); 
				return $last_id;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		
		}
		
		
		
		//********************************************************************************
		//	update articles
		//********************************************************************************
		public function update($form, $id){
				
			$this->title = $form['title'];
			$this->description = $form['info'];
			//$this->img;
			
			$this->sql = 	"UPDATE articles 
							SET
							title_articles = :title, 
							info_articles = :description
							WHERE id_articles = :id";

			//Query Parameters
			$query_params = array(
				"title" => $this->title, 
				"description" => $this->description, 
				"id" => $id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				$last_id = $db->lastInsertId(); 
				return $last_id;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}

		
		}
		
		//********************************************************************************
		//	Delete a row from articles
		//********************************************************************************
		public function delete($id){
				$this->sql = 	"DELETE FROM articles
							WHERE id_articles = :id";

			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
			   	$this->query = $stmt;
			   	
				
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
			
			
		}
		
		
		//Previous row
		public function return_previous($id){
		
			$this->id = $id;
			$this->sql ="SELECT *
			  FROM articles
			  WHERE id_article < :id
			  ORDER BY id_article DESC
			  LIMIT 1";

			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
			   	$this->row = $stmt->fetch();
			   	
				return $this->row;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
		}
		
		
		//Next row
		public function return_next($id){
		
			$this->id = $id;
			$this->sql ="SELECT *
			FROM articles
			WHERE id_article > :id
			ORDER BY id_article ASC
			LIMIT 1";
	
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
			   	$this->row = $stmt->fetch();
			   	
				return $this->row;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}

		}
		
		
		
		//********************************************************************************
		//	update articles
		//********************************************************************************
		public function update_views( $id, $wall){
				
			//$this->img;
			
			$this->sql = 	"UPDATE articles 
							SET
							img_wall_article = :wall
							WHERE id_article = :id";

			//Query Parameters
			$query_params = array(
				"wall" => $wall, 
				"id" => $id
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
		
		//********************************************************************************
		// SELECT ALL
		//********************************************************************************
		public function select_images_del($page = NULL, $offset = NULL){
			$this->sql = "SELECT * FROM articles 
			JOIN users ON articles.posted_by_article = users.user_id
			ORDER BY articles.posted_on_article DESC
			LIMIT 235, 500";
			
			if($page != NULL )
			{
				$this->sql .= " LIMIT {$page} OFFSET {$offset}";
			}
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute();
				//$last_id = $db->lastInsertId();    

			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
		}
		
	}
?>