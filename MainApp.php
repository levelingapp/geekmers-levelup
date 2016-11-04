<?php
/**
* @author Luis Vazquez
* Date : 05/11/2012
* MainApp class: 	The purpose of this class is to Manage the LevelUp_Framework.
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class MainApp extends LevelUp_Framework{
	
	private $files = array();
	private $filesUnderScore = array();
	private $totalFiles;
	private $currentPage;
	
	/**
	* Initialize main
	*/
	public function init(){
		/*
		$id = 4;
		$nick = "luis";
		$this->session->login($id, $nick);
		
		echo "<br />user: " . $this->session->user() . "<br />";
		
		$this->test->testing();
		*/
		//check login
		$this->currentPage = $this->curPageURL();
		
		
		//validate login the one that is on the header
		$this->validate_login();
		
		//logout from session
		$this->logout();
		
		
		//Initialize controllers
		$this->loadControll();
		
	}
	
	/**
	* Load controllers
	*/
	public function loadControll(){
	
		//Get Parameters
		$request =  $this->request->getRequest();
		
		//load Files
		$this->loadFiles();
		
		//send to index
		if($request[0] == ""){
		
			$indexController = new IndexController();
			$indexController->indexAction();
		}
		
		//get first parameter and check if the second paramaeter is an integer
		elseif($request[0] != "" && is_numeric($request[1])){
			
			$countFiles = 0;
			//Loop and read all files
			for($i = 0; $i < $this->totalFiles; $i++){
				///find file name
				$posController = strpos($this->files[$i],"Controller");
				$fileName = strtolower(substr($this->files[$i], 0 , $posController)); 
				
				if($fileName == $request[0]){
					$posPhp = strpos($this->files[$i],".php");
					#$className = strtolower(substr($this->filesUnderScore[$i], 0 , $posPhp));
					$className = substr($this->filesUnderScore[$i], 0 , $posPhp);
					
					//creates a dinamic object from the class
					$pageController = new $className;
					if( method_exists( $pageController, "viewAction" ) ){
						$pageController->viewAction();
					}else{
						//echo "<p>Please Add a <strong>viewAction</strong> method in your class <span style='color:red'><strong>" . $className . "<strong><span></p>";
						echo "<br />file doesn't exsists<br />";
					}
					
					
					break;
				}
				$countFiles++;
			}
			
			//if file doesn't exist send them to 404 error page
			if($countFiles == $this->totalFiles){
				
				$errorController = new ErrorController();
				$errorController->error_404Action();
				//echo "<br />file doesn't exsists<br />";
			}
			
		}
		
		
		
		//get first parameter and check if the second paramaeter is a String
		elseif($request[0] != "" && is_string($request[1]) && $request[1] != ""){
			
			$countFiles = 0;
			$countMethods = 0;
			//Loop and read all files
			for($i = 0; $i < $this->totalFiles; $i++){
				///find file name
				$posController = strpos($this->files[$i],"Controller");
				$fileName = strtolower(substr($this->files[$i], 0 , $posController)); 
				
				if($fileName == $request[0]){
					$posPhp = strpos($this->files[$i],".php");
					$className = strtolower(substr($this->filesUnderScore[$i], 0 , $posPhp));
					
					//creates a dinamic object from the class
					$pageController = new $className;
					
					//get ALL class methods
					$classMethods = get_class_methods($className);
					
					//change request to the right method Name
					$requestMethodAction = $request[1] . "Action";
				
					//loop all functions
					for($j = 0 ;  $j < count($classMethods); $j++){

						//check if is the right method
						if($classMethods[$j] == $requestMethodAction){

							//Check if method exists
							if( method_exists( $pageController, $classMethods[$j] ) ){
								$pageController->$requestMethodAction();
							}
							else{
								echo "<br />file doesn't exsists<br />";
							}
							
							break;
						}
						$countMethods++;
					}
	
					//if file doesn't exist send them to 404 error page
					if($countMethods  == count($classMethods)){
					
						$errorController = new ErrorController();
						$errorController->error_404Action();
					}
					
					break;
				}
				$countFiles++;
			}
			
			//if file doesn't exist send them to 404 error page
			if($countFiles == $this->totalFiles){
				$errorController = new ErrorController();
				$errorController->error_404Action();
			}
		}
		
		
		
		
		//get first parameter and check if the second paramaeter is empty
		else if($request[0] != ""){

			$countFiles = 0;
			//Loop and read all files
			for($i = 0; $i < $this->totalFiles; $i++){
				///find file name
				$posController = strpos($this->files[$i],"Controller");
				$fileName = strtolower(substr($this->files[$i], 0 , $posController)); 
				
				if($fileName == $request[0]){
					$posPhp = strpos($this->files[$i],".php");
					$className = substr($this->filesUnderScore[$i], 0 , $posPhp); // i removed the strtolower
					
					
					//echo "Main app: " . $className . "<br />";
					
					//creates a dinamic object from the class
					$pageController = new $className;
					
					//Check if file exists
					if( method_exists( $pageController, "indexAction" ) ){
						$pageController->indexAction();
					}else{
						//echo "<p>Please Add a <strong>viewAction</strong> method in your class <span style='color:red'><strong>" . $className . "<strong><span></p>";
						$errorController = new ErrorController();
						$errorController->error_404Action();
					}
					
					break;
				}
				$countFiles++;
			}
			
			//if file doesn't exist send them to 404 error page
			if($countFiles == $this->totalFiles){
				$errorController = new ErrorController();
				$errorController->error_404Action();
			}
		}

	}
	
	/**
	* Load Files
	*/
	private function loadFiles(){
		$handle = opendir("application/controller");

		//loop and find files
		while (($file = readdir($handle))!== false) {
			if($file !== "." && $file !== "..")
			$this->files[] .= $file;
		}
		closedir($handle);
		
		
		//Find if is "-" and change it to underscore "_"
		for($i=0; $i < count($this->files); $i++){
			$this->filesUnderScore[$i] = str_replace("-","_", $this->files[$i]);
		}
		
		//total of files on Controll folder
		$this->totalFiles =  count($this->files);
	}
	
	/**
	* Logout Session
	*/
	public function logout(){
		if(isset($_POST["submitted_login"])){
			$this->session->logout();
			$path = PATH ;
			header("Location: {$path}");
		}
	}
	
	/**
	***************************************************************************************
	* Validate login the one that is on the header
	***************************************************************************************
	*/
	public function validate_login(){
		//header_email header_password header_submit
		if(isset($_POST["header_submit"])){

			//Declaring Object user
			$users = new Users();
			
			$email = $_POST["header_email"];
			$password = $_POST["header_password"];

			//check if user exsist
			$user_id = $users->check_password($email, $password);
			if( $user_id != false ){

				$id = $user_id;
				$nick = $users->return_nick_by_id($id);
				$row_nick = $nick->fetch();
				
				//start session
				$this->session->login($id, $row_nick['user_nick']);
				
				//send to current page 
				$path = $this->curPageURL();
				
				//change before upload
				$pathHome = PATH;				//"http://localhost/levelingapp/";
				$pathJoin = PATH . "register/";	//"http://localhost/levelingapp/up/join/";
				
				//echo $pathHome;
				if($path == $pathHome || $path == $pathJoin){
					$path = PATH . "geekmer/".  $user_id;
				}
				header("Location: {$path}");

			}
			else{
				//send to register 
				$path = PATH . "register/";
				header("Location: {$path}");
			}
			
		}
	}
	
	/**
	**************************************************************************************
	* Return the current page 
	*************************************************************************************
	*/
	function curPageURL() {
		$pageURL = 'http';
		if(!empty($_SERVER['HTTPS'])){
			if ($_SERVER["HTTPS"] == "on"){
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80"){
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		return $pageURL;
	}
	

	
}

?>