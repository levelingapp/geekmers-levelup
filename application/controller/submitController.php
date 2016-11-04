<?php
class SubmitController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
	
		//check if is login if not send them to Main page
		$session = $this->session->user();
		if( !isset( $session ) ){
			$path = PATH . "register/";
			header("Location: {$path}");
			exit();
		}
		

		if(isset($_POST['submitted'])){
		
			$form = array();
			$form['title'] = $_POST['title'];
			$form['url']  = $_POST['url'];
			$form['file']  = $_POST['file'];
			$form['urlVideo']  = $_POST['urlVideo'];
			$form['sourceUrl']  = $_POST['sourceUrl'];
			$form['NSFW']  = $_POST['NSFW'];
			$form['type_url']  = $_POST['type_of_upload'];
			
			
			if($form['type_url']  == "picture"){
				// Picture
				//echo $form['NSFW'] . "<br />";
				//echo $form['title'] . "<br />";
				
				
				
				//Upload image
				if(isset($_FILES['upload']['name']) && $_FILES['upload']['name'] != ""){
					$checkExtensions = new CheckExtensions();
					$checkExtensions->setPath("images/original");
					
					if(!$checkExtensions->execute($_FILES, "upload")){
						$errorMsg =  $checkExtensions->error();
					}else{
						$iconName =  $checkExtensions->name();
						//echo $iconName . "<br />";
						$files["original"] = $iconName;
						
					
						//Create Wall Thumb
						$thumb = new Thumb();
						$thumb->path("images/original/", "images/wall/");
						$thumb->setResize(620);
						$files["wall"] = $thumb->execute($iconName);

						//Create small Thumb
						$thumb = new Thumb();
						$thumb->path("images/original/", "images/thumb/");
						$thumb->setResize(200);
						$files["thumb"] = $thumb->execute($iconName);
						
					}
					
				}

				//Don't delete this is when user upload an images through url
				if( $form['url'] != "" ){

					$checkExtensions2 = new CheckExtensions();
					$checkExtensions2->setPath("images/original");
					
					//it's a url
					$checkExtensions2->URL();
					if( !$checkExtensions2->execute( $_POST['url']) ){
						$errorMsg =  $checkExtensions2->error();
					}else{
						$iconName =  $checkExtensions2->name();
						//echo $iconName . "<br />";
						$files["original"] = $iconName;
						
					
						//Create Wall Thumb
						$thumb = new Thumb();
						$thumb->path("images/original/", "images/wall/");
						$thumb->setResize(620);
						$files["wall"] = $thumb->execute($iconName);

						//Create small Thumb
						$thumb = new Thumb();
						$thumb->path("images/original/", "images/thumb/");
						$thumb->setResize(200);
						$files["thumb"] = $thumb->execute($iconName);
						
					}	

				}
				
				
				if(!isset($errorMsg)){
					$id_login = $this->session->user();
					$article = new Article();
					$id_article = $article->insert($_POST, $id_login, $files);
				}
				
				$path = PATH . "id/{$id_article}/";
				header("Location: {$path}");
				
			}else{
				// video
				$id_login = $this->session->user();
				$article = new Article();
				$id_article = $article->insert_videos($_POST, $id_login, $files);
				
				$path = PATH . "id/{$id_article}/";
				header("Location: {$path}");
			}
		}
		
		require_once("application/views/submit/index.php");
	}
	
	public function createThumbs(){
		
	}

}
?>