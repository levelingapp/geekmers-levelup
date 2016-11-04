<?php
class TestluisController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
	/*
	$article = new Article();
	$query = $article->select_images_del();
	
	
	//Create Wall Thumb
	$thumb = new Thumb();
	
	while($row = $query->fetch()){
		$id = $row['id_article'];
		
		if($id == "409"){
			continue;
		}
		
		$iconName = $row['img_original_article'];
		echo  $id . "<br/>";
		echo "images original: " . $iconName . "<br/>";
		echo "images view: " . $row['img_view_article'] . "<br/>";
		
		$thumb->path("images/original/", "images/wall/");
		$thumb->setResize(620);
		$wall = $thumb->execute($iconName);
		
		
		$article->update_views( $id, $wall);

	}
	*/
	
	/*
	
	$thumb->path("images/original/", "images/wall/");
	$thumb->setResize(620);
	$files["wall"] = $thumb->execute($iconName);
	*/
	
	
	echo "hello";
		
		//require_once("application/views/test/test-luis.php");
	}
	
	public function createThumbs(){
		
	}

}
?>