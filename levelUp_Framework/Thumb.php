<?php
/**
* @author Luis Vazquez
* Date : 06/17/2011
* Thumb class: 	The purpose of this class is to create thumbnails of any Picture
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class Thumb{
	private $width;
	private $height;
	private $new_width;
	private $new_height;
	private $pathImages;
	private $pathToThumbs;
	private $fileName;
	private $newFileName;
	private $extension; 
	private $img;				//stores new binary image i guess
	private $fileNoExtension;	//it shows only the name of the image without extension
	private $finalName;			//it show the final name
	private $small_height;		//small height ** inverts the process
	
	/**
	* Create thumbs
	*/
	public function createThumbs(){
	
		$dir = opendir( $this->pathImages );
		
		//checking for name and extensions
		$this->extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $this->fileName);
		$this->extension = strtolower($this->extension);
		$this->fileNoExtension = preg_replace('/\.[^.]*$/', '', $this->fileName);
		
		// load image and get image size
		$this->loadImage($this->extension);
		$this->width = imagesx( $this->img );
		$this->height = imagesy( $this->img );
		
		
		if($this->small_height == true){
			//changing the width
			
			$this->new_height = $this->new_width;
			
			if($this->height < $this->new_height){
				$this->tempImage($this->width,$this->height);
			}
			else{
			
				$this->new_width = floor( $this->width * ( $this->new_height / $this->height ) );
				$this->tempImage($this->new_width, $this->new_height);
			}

		}
		else{
			//changing the height
			if($this->width < $this->new_width){
				//call tempimage
				$this->tempImage($this->width,$this->height);
			}
			else{
				$this->new_height = floor( $this->height * ( $this->new_width / $this->width ) );
				$this->tempImage($this->new_width, $this->new_height);
			}
			//$this->new_height = floor( ($this->height / $this->width) * $this->new_width  );
		}


		// close the directory
		closedir( $dir );
	  
	}
	
	/**
	* The most improtant function in thumb
	*/
	public function tempImage($width, $height){

		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $width, $height );

		//change alpha
		imagealphablending($tmp_img, false);
		imagesavealpha($tmp_img, true); 
	
		//background
		$background = imagecolorallocatealpha($tmp_img, 0, 0, 0,0);

		
		//testing
		imagecolortransparent($tmp_img, $background );
		//imagefilledrectangle($tmp_img, 0, 0, $width, $height, $background);
			
		// copy and resize old image into new image
		imagecopyresampled( $tmp_img, $this->img, 0, 0, 0, 0, $width, $height, $this->width, $this->height );
	

		//added by me
		$this->finalName = $this->fileNoExtension . "_". $width. "_". $height . ".".$this->extension;
	  
		//*******************************************************************
		
		$this->createImage($this->extension, $tmp_img, "{$this->pathToThumbs}{$this->finalName}" );
	}
	
	/**
	* Here is the path of your saved pictures
	*/
	public function path($pathImages,$pathToThumbs){
		$this->pathImages = $pathImages;
		$this->pathToThumbs = $pathToThumbs;
	}
	
	/**
	* The size of your new thumbnails
	*/
	public function setResize($width, $small_height = NULL){
		//set the width
		$this->new_width = $width;
		
		//height is inverted
		$this->small_height = $small_height;

	}
	
	/**
	* Return a string with the right path
	*/
	public function execute($fileName){
		$this->fileName = $fileName;
		$this->createThumbs();
		
		return $this->finalName;
	}
	
	/**
	* loading the right extension
	*/
	public function loadImage($ext){
		switch($ext){
			case "jpg":
				$this->img = imagecreatefromjpeg("{$this->pathImages}{$this->fileName}");
				//imagejpeg($this->img,"{$this->pathImages}{$this->fileName}", 100);
				break;
			case "png":
				$this->img = imagecreatefrompng("{$this->pathImages}{$this->fileName}");
			//	imagepng($this->img,"{$this->pathImages}{$this->fileName}");
				break;
			case "gif":
				$this->img = imagecreatefromgif("{$this->pathImages}{$this->fileName}");
				//imagegif($this->img,"{$this->pathImages}{$this->fileName}");
				break;
		}
		return $this->img;
	}
	
	/**
	* Creating the right extension
	*/
	public function createImage($ext,$img,$path){
		switch($ext){
			case "jpg":
				imagejpeg($img,$path, 100);
				break;
			case "png":
				imagepng($img,$path);
				break;
			case "gif":
				imagegif($img,$path);
				break;
		}
	}


}

//***********************************
//Example of objects
//***********************************

/*$thumb = new Thumb();
$thumb->path("upload/","upload/thumbs/");
$thumb->setResize(250);
$thumb->execute("Koala.jpg");
*/


/*$thumb = new Thumb();
$thumb->path("upload/","upload/thumbs/");
$thumb->setResize(250,true); //true could be optional
$thumb->execute("Koala.jpg");
*/

?>