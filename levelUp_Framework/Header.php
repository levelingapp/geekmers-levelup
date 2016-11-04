<?php
/**
* @author Luis Vazquez
* Date : 06/17/2011
* Header class: 	The purpose of this class is to improve SEO in web site
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class Header{
		private $meta_description;
		private $meta_tags;
		private $title;
		private $url_property;
		private $image_property;
		private $property_description;
		private $title_property;
		private $site_name;
		private $type_property;
		private $isNotIndex;
	
	/**
	* Constructor
	*/
	public function __construct(){
	
		$path = PATH;
	
		$this->meta_description = "Geekmers is the best website where you can discover and collect geek stuff and funny video game pictures.";
		
		$this->meta_tags = "funny, pictures, video, games, geek, geekmers, video games, nerds, awesome, noob, pwnd, memes";
		
		$this->title = "Geekmers";
		
		$this->title_property = "Geekmers";
		$this->url_property = "http://www.geekmers.com/";
		$this->image_property = "{$path}image/assets/Logo.jpg" ;
		$this->property_description = $this->meta_description;
		$this->site_name = "Geekmers";
		$this->type_property = "games";
		
		$this->isNotIndex = false;
		
	}
	
	/**
	* get meta description
	*/
	public function get_meta_description(){
		return $this->meta_description;
	}
	
	/**
	* set tags
	*/
	public function set_tags($tag){
		$this->meta_tags = $tag . " ," . $this->meta_tags;
	}
	
	/**
	* get tags
	*/
	public function get_tags(){
		return $this->meta_tags;
	}
	
	/**
	* set title
	*/
	public function set_title($title){
		$this->title = $this->site_name . " | ". stripslashes($title);
		$this->set_title_property();
	}
	
	/**
	* get title
	*/
	public function get_title(){
		return $this->title;
	}
	
	/**
	* set description
	*/
	public function set_description($description){
		$this->meta_description = $description;
		$this->meta_description = strip_tags($description);
		$this->meta_description = htmlentities($this->meta_description, ENT_QUOTES);
		$this->meta_description = trim($this->meta_description);
		$this->meta_description = substr($this->meta_description,0,500);
	}
	
	/**
	* get description
	*/
	public function get_description(){
		return $this->meta_description;
	}
	
	/**
	* set title property
	*/
	public function set_title_property(){
		$this->title_property = htmlentities($this->title, ENT_QUOTES);
	}
	
	/**
	* get title property
	*/
	public function get_title_property(){
		return $this->title_property ;
	}
	
	/**
	* set url
	*/
	public function set_url_property($url){
		$this->url_property = $url;
	}
	
	/**
	* get url
	*/
	public function get_url_property(){
		return $this->url_property;
	}
	
	/**
	* set image path
	*/
	public function set_image($path){
		$this->image_property = $path;
	}
	
	/**
	* get image path
	*/
	public function get_image(){
		return $this->image_property;
	}
	
	/**
	* set property description
	*/
	public function set_property_description($property_description){
		$this->property_description = strip_tags($property_description);
		$this->property_description = htmlentities($this->property_description, ENT_QUOTES);
		$this->property_description = trim($this->property_description);
		$this->property_description = substr($this->property_description,0,500);
		
	}
	
	/**
	* get property description
	*/
	public function get_property_description(){
		return $this->property_description;
	}
	
	/**
	* get site name
	*/
	public function get_site_name(){
		return $this->site_name ;
	}
	
	/**
	* get type name
	*/
	public function get_type(){
		return $this->type_property ;
	}
	
	/**
	* set
	*/
	public function set_index_robots($check){
		$this->isNotIndex = $check;
	}
	
	/**
	* index robots
	*/
	public function get_index_robots(){
		if($this->isNotIndex)
			return '<meta name="robots" content="noindex">';
	}
		
	
}

//declaring the object

?>