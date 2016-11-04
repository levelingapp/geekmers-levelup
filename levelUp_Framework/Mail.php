<?php
/**
* @author Luis Vazquez
* Date : 06/17/2011
* Mail class: 	TThe purpose of this class is to send emails
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class Mail{
	private $subject;
	private $email;
	private $email2;
	private $email3;
	private $name;
	private $message;
	private $content;
	
	private $host;
	private $user;
	private $pass;
	private $from;
	private $fromName;
	private $contentHTML;

	/**
	* CONSTRUCTOR
	*/
	public function __construct(){
	
		$this->host = "www.devieal.com";
		//$this->email = "luis.g.vazquez@hotmail.com";
		$this->email = "luis.g.vazquez@hotmail.com";
		//$this->email2 = "chriskhuong@levelingapp.com";
		//$this->email3 = "einsquared@gmail.com";
		$this->user = "lordluis";
		$this->pass = "evangelio04";
		$this->from = "do_not_reply@devieal.com";
		$this->fromName = "Leveling App";
	}	

	/**
	* This function assign subject
	*/
	public function addSubject($subject){
	
		$this->subject = $subject;
	}		

	
	/**
	* This function assign Address
	*/
	public function addAddress($email, $name){
	
		$this->email = $email;
		$this->name = $name;
	}
	
	/**
	* This function when is called send the email
	*/
	public function send(){
	
		$mail = new PHPMailer();

		$mail->IsSMTP();                                      	// set mailer to use SMTP
		$mail->Host = $this->host;  							// specify main and backup server
		$mail->SMTPAuth = true;     							// turn on SMTP authentication
		$mail->Username = $this->user; 							// SMTP username
		$mail->Password = $this->pass; 							// SMTP password

		$mail->From = $this->from;
		$mail->FromName = $this->fromName;
		
		$mail->AddAddress($this->email, $this->name);
		//$mail->AddAddress($this->email2);       		        // name is optional
		//$mail->AddAddress($this->email3);       		        // name is optional
		$mail->AddReplyTo($this->from, $this->fromName);

		$mail->WordWrap = 50;                                 	// set word wrap to 50 characters
		//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
		//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
		$mail->IsHTML(true);                                  	// set email format to HTML

		$mail->Subject = $this->subject;
		$mail->Body    = $this->content;
		$mail->AltBody = $this->contentHTML;					//This is the body in plain text for non-HTML mail clients


		if(!$mail->Send())
		{
		   return false;
		}
		else{
			return true;
		}
		
	}
	
	
		
	/**
	* This function assign message
	*/
	public function addMessage($message){
	
		$this->message = $message;
		
		
		$this->content = "
		
		<html>
		<head>
		<style>
			body{
				font-family:Verdana, Geneva, sans-serif; 
				font-size:12px;
			}
			
			#container{
				border: 1px solid #CCC;
				width:600px;
				padding: 20px;
				background-color:#CCC;
			}
			#banner{
				background-color:#282828;;
				height: 40px;
				padding:5px;
				color: white;
				font-size: 16px;
			}
			
			#banner h1{
				font-size: 16px;
				margin-top: 0px;
				margin-bottom: 0px;
				padding-bottom: 0px;
				padding-top: 0px;
				padding-left: 14px;
			}
			
			#content{
				padding:10px;
				padding-left: 15px;
				color: blck;
				font-size: 12px;
				background-color: white;
				border-bottom: 1px solid #282828;;
			}
			
			#ignore{
			margin-top: 10px;
			padding:5px;
			font-size: 10px;
			}
			#box{
				padding:10px;
				color: #06C;
				border: 2px solid #CCC;
				width: 190px;
				background-color: #F0F0F0;
				margin-top 5px;
				margin-bottom 5px;
			}
			#box a{
				color: #06C;
				text-decoration: none;
			}
			
			.buttonStart{
				background-color: #67a54b;
				color: white;
				font-weight: bold;
				padding: 5px;
				border: 1px solid #666;
				width: 100px;
				text-align: center;
				text-decoration: none;
			}
			.buttonStart a{
				color: white;
				font-weight: bold;
				text-decoration: none;
			}

		</style>
		</head>
		<body>
		<div id ='container'>
			<div id='banner'>
			<h1><img src=\"/levelingapp/images/assets/levelingappLogoEmails.png\" alt=\"Leveling App\" title=\"Leveling App\" /></h1>
			</div>	
			
			<div id='content'>
			<p>Hi {$this->name},</p>
			<p>
			{$this->message}
			</p>
			
			<br />
			<p>Thanks,</p>
			<p>Leveling App Team</p>
			
			</div>
			<div id='ignore'>
			The message was sent to {$this->email}.
			</div>
		</div>

		</body>
		</html>
		
		";
		
		//assign a message for those who doesn't support html
		$this->content_html();
	}
	
	/**
	* content HTML
	*/
	public function content_html(){
		$this->contentHTML = "Hi {$this->name},\n
		{$this->message} \n
		West Loop Games Team \n
		The message was sent to {$this->email}.\n
	";
	
	}

}
?>