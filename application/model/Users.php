<?php
//***************************************************************************************
// Date: 01/23/2012
// Created by Luis Vazquez
// Purpose: This class help you add, update, and delete user from database
//***************************************************************************************
class Users extends Connection{

	private $id;
	private $fname;
	private $lname;
	private $email;
	private $password;
	private $nick;
	private $dob;
	private $dor;
	private $level;
	private $website;
	private $about_me;
	private $gender;
	private $last_seen;
	private $ip;
	private $flag;
	private $sex;
		
		
	//sql
	private $sql;
	private $query;
	private $row;
	
	private $check;
	
	
		
	//******************************************************************
	//Select ALL Users
	//******************************************************************
	public function select_all(){
		$this->sql = "SELECT * FROM users";

		
		try {
			// Execute the query to create the user 
			$stmt =  parent::$db->prepare($this->sql); 
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
	
		
	//******************************************************************
	//Select by ID
	//******************************************************************
	public function select_by_id($id){
		$this->id = $id;
		$this->sql = "SELECT * FROM users WHERE users.user_id = :id";
		
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
	
	//******************************************************************
	//Select by ID and return ONLY the nick name
	//******************************************************************
	public function return_nick_by_id($id){
		$this->id = $id;
		$this->sql = "SELECT user_nick FROM users WHERE users.user_id = :id";
		
		
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
	
	
	//******************************************************************
	//Select by ID and return ONLY the nick name
	//******************************************************************
	public function check_if_nick_exist($nick){
		$this->id = $nick;
		$this->sql = "SELECT count(*) AS total FROM users WHERE users.user_nick = :nick";

		//Query Parameters
		$query_params = array(
			':nick' => $this->id
		);


		try{
			// Execute the query to create the user 
			$stmt =  parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 

			$row = $stmt->fetch();
			
			return $row['total'];	

		}
		
		catch(PDOException $ex){
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}
		
	}


	//******************************************************************
	//Select by Nick
	//******************************************************************
	public function select_by_nick($nick){
		$this->nick = $nick;
		$this->sql = "SELECT * FROM users WHERE users.user_nick = :nick";
		
		
		//Query Parameters
		$query_params = array(
			':nick' => $this->nick
		);


		try{
			// Execute the query to create the user 
			$stmt =  parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 
			
			return $stmt;

		}
		
		catch(PDOException $ex){
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}
	}
	
		
	//******************************************************************
	//Select by Email
	//******************************************************************
	public function select_by_email($email){
		$this->email = $email;
		$this->sql = "SELECT * FROM users WHERE users.user_email = :email";
		
		
		//Query Parameters
		$query_params = array(
			':email' => $this->email
		);


		try{
			// Execute the query to create the user 
			$stmt =  parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 
			
			return $stmt;

		}
		
		catch(PDOException $ex){
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}
	}
	
	//******************************************************************
	//Select all Admin
	//******************************************************************
	/*
	public function select_all_admin(){
		$this->sql = "SELECT * FROM user WHERE user.status_user ='admin'";
		$this->query = mysql_query($this->sql);
		
		return $this->query;
	}
	*/
	
		
	//******************************************************************
	//Check Login
	//******************************************************************
	public function check_password($email,$password){
	
		$check = false;
		$this->email = trim( $email );
		$this->password = sha1( trim($password) );
		
		$this->sql = "SELECT * FROM users WHERE users.user_email = :email AND users.user_password = :password";


		//Query Parameters
		$query_params = array(
			':email' => $this->email,
			':password' => $this->password
		); 
		
		try {
			// Execute the query to create the user
			$stmt = parent::$db->prepare($this->sql);
			$result = $stmt->execute($query_params);
			//$last_id = $db->lastInsertId();    
	
			$this->query = $stmt;
			$this->row = $this->query->fetch();
			
			
			if(empty($this->row)){
				$check = false;
			}
			else{
				$check = $this->row['user_id'];
			}
	
			return $check;
		}
	   
		catch(PDOException $ex) {
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code. 
			die("Failed to run query: " . $ex->getMessage());
		}

		
	}

	
	//******************************************************************
	//update Info
	//******************************************************************
	public function update($info, $id){
		$this->fname = $info['fname'];
		$this->lname = $info['lname'];
		$this->email = $info['email'];
		$month = $info['month'];
		$day = $info['day'];
		$year = $info['year'];
		$this->dob = $year . "-" . $month . "-" . $day;
		
		
		if($info['gender'] == "male"){
			$this->gender = "male"; 
		}else{
			$this->gender = "female";
		}
		
		
		if($info['nsfw'] == "YES"){
			$this->nsfw = "YES"; 
		}else{
			$this->nsfw = "NO";
		}
		
		
		$this->id = $id;
		$this->sql = 	"UPDATE users
						SET 
						user_fname = :fname, 
						user_lname = :lname, 
						user_email = :email, 
						user_dob = :dob, 
						user_gender = :gender,
						user_nsfw = :nsfw
						WHERE user_id = :id";
						
		//Query Parameters
		$query_params = array(
			':fname' =>$this->fname,
			':lname' => $this->lname,
			':email' => $this->email,
			':dob' => $this->dob,
			':gender' => $this->gender,
			':nsfw' => $this->nsfw,
			':id' => $this->id
		);


		try{
			// Execute the query to create the user 
			$stmt =  parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 
			
			return $stmt;
		}
		
		catch(PDOException $ex){
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}
		
		
	
	}
	
		
	//******************************************************************
	//Update Password
	//******************************************************************
	public function update_password($pass, $id){
		$this->id = $id;
		$this->password = sha1(mysql_real_escape_string($pass));
		
		$this->sql = 	"UPDATE users
						SET user_password = :password
						WHERE user_id = :id";

		//Query Parameters
		$query_params = array(
			':password' => $this->password,
			':id' => $this->id
		);


		try{
			// Execute the query to create the user 
			$stmt =  parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 
			
			return $stmt;

		}
		
		catch(PDOException $ex){
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}
	
	}
	
		
	//******************************************************************
	//Insert Values
	//******************************************************************
	public function insert($form){
		$this->fname = ucfirst(strtolower(trim($form['fname']))); //strtolower
		$this->lname = ucfirst(strtolower(trim($form['lname'])));
		$this->nick = strtolower(trim($form['nick']));
		$this->email = strtolower(trim($form['email']));
		$month = $form['month'];
		$day = $form['day'];
		$year = $form['year'];
		$this->dob = $year. "-". $month."-".$day; //2012-01-24
		$this->dor = date('Y-m-d H:i:s'); //2012-01-24 19:20:38
		$this->sex = $form['gender'];
		$pass = trim($form['password']);
		$this->password = sha1($pass);
		//$this->img;
		$this->sql = 	"INSERT INTO 
						users 
						(
						user_fname, 
						user_lname, 
						user_nick, 
						user_email, 
						user_password, 
						user_dob, 
						user_dor, 
						user_nsfw, 
						user_gender  
						)
						VALUES 
						(
						:fname, 
						:lname, 
						:nick, 
						:email, 
						:password, 
						:dob, 
						:dor, 
						'NO', 
						:sex
						)";

						
		//Query Parameters
		$query_params = array(
			':fname' =>$this->fname,
			':lname' => $this->lname,
			':nick' => $this->nick,
			':email' => $this->email,
			':password' => $this->password,
			':dob' => $this->dob,
			':dor' => $this->dor,
			':sex' => $this->sex
		);


		try{
			// Execute the query to create the user 
			$stmt =  parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 
			
			$last_id =  parent::$db->lastInsertId();
			return $last_id;
		}
		
		catch(PDOException $ex){
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}
	}	

				
}
?>