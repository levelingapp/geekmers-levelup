<?php
class RegisterController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){

		if($_POST['submitted']){
				
				
			
			if(	$_POST['fname'] != "" && 
				$_POST['lname'] != "" && 
				$_POST['nick'] != "" && 
				$_POST['email'] != "" && 
				$_POST['confirm_email'] != "" && 
				$_POST['password'] != "" && 
				$_POST['gender'] != "" && 
				$_POST['month'] != "" && 
				$_POST['day'] != "" && 
				$_POST['year'] != ""		
			){
				
				require_once('levelUp_Framework/includes/recaptcha/recaptchalib.php');
				$privatekey = "6Ldh4_sSAAAAADYepnrxuLmjIWyhd8_JF7ZxdAGD";
				$resp = recaptcha_check_answer ($privatekey,
				                                $_SERVER["REMOTE_ADDR"],
				                                $_POST["recaptcha_challenge_field"],
				                                $_POST["recaptcha_response_field"]);
				
				if (!$resp->is_valid) {
					// What happens when the CAPTCHA was entered incorrectly
					$msg = "The reCAPTCHA wasn't entered correctly. Go back and try it again.";
				} else {
					// Your code here to handle a successful verification
					$user = new Users();
					//check if nick exsist
					$result_nick = $user->check_if_nick_exist($_POST['nick']);
					
					if($result_nick == 0){
						
						if( $_POST['email'] == $_POST['confirm_email'] ){
							$id = $user->insert($_POST);			
							
							//start session
							$this->session->login($id, $_POST['nick']);
							
							$path = PATH;
							header("location: {$path}");
							
						}else{
							$msg = "Emails are not the same.";
						}
					}else{
						$msg = "Nickname is already in use.";
					}
				
				
				}// End recaptcha
			
			}else{// END if statement if is submitted
				
				$msg = "Some of the fields are empty";
			}
				
		}// don't show anything if is not submitted


		require_once("application/views/register/index.php");
	}
	

}
?>