<?php
class SettingsController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
	
		//check if is login if not send them to Main page
		$session = $this->session->user();
		if( !isset( $session ) ){
			$path = PATH;
			header("Location: {$path}");
			exit();
		}

		$id = $this->session->user();
		$user = new Users();
		$result = $user->select_by_id($id);
		
		$row = mysql_fetch_assoc($result);
		
		$dayUser = date("d", strtotime($row['user_dob']));
		$monthUser = date("m", strtotime($row['user_dob']));
		$yearUser = date("Y", strtotime($row['user_dob']));

		if($row['user_gender'] == "male"){
			$maleSelected = 'checked'; 
			$femaleSelected = ""; 
		}else{
			$femaleSelected = 'checked'; 
			$maleSelected = ""; 
		}
		
		
		
		if($row['user_nsfw'] == "YES"){
			$nsfwYes = 'checked'; 
			$nsfwNo = ""; 
		}else{
			$nsfwNo = 'checked'; 
			$nsfwYes = ""; 
		}
		
		
		if(isset($_POST['submitted'])){
			$send = true;
			
			if(isset($_POST['password_show'])){
				if($_POST['old_password'] != "" || $_POST['new_password'] != "" || $_POST['confirm_password'] != ""){
					
					$old  = $_POST['old_password'];
					$new = $_POST['new_password'];
					$confirm = $_POST['confirm_password'];
					
					if($new == $confirm){
						$check = $user->check_password($row['user_email'],$old);
						if($check != false){
							$user->update_password($new, $id);
							$send = true;
						}
						else{
							$errorMsg = "OLD password doesn't match our database.";
							$send = false;
						}
						
					}else{
						$errorMsg = "NEW password doesn't match CONFIRM password.";
						$send = false;
					}
					
				}else{
					$errorMsg = "One of the Paswords Fields is empty.";
					$send = false;
				}
			
			}//password_show
			
			$user = new Users();
			$user->update($_POST, $id);
			
			if($send){
				$path = PATH . "settings/";
				header("Location: {$path}");
			}
			
		}
		
		
		
		require_once("application/views/settings/index.php");
	}

}
?>