<?php
/**
* @author Luis Vazquez
* Date : 06/17/2011
* Embededgames class: 	The purpose of this class is to help you insert the right game type
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
	class EmbededGames{
	
		//Variables
		private $width;
		private $height;
		private $code;
		private $title;
		private $path;
		private $fileName;
		private $type;
		
		/**
		* Constructor
		*/
		public function __construct($path ="", $title = "", $width = 550, $height = 450){
			$this->width = $width;
			$this->height = $height;
			$this->title = $title;
			$this->path = $path;
		}
		
		/**
		* Set File Name
		*/
		public function SetFileName($fileName){
			$this->fileName = $fileName;
		}
		
		/**
		* Set path
		*/
		private function SetPath($path){
			$this->path = PATH . "games/{$path}/". $this->fileName;
			
		}
		
		/**
		* Set Size (width and Height)
		*/
		public function SetSize($width = 550, $height = 450){
			$this->width = $width;
			$this->height = $height;
		}
		
		/**
		* Set Title
		*/
		public function SetTitle($title){
			$this->title = $title;
		}
		
		/**
		* Execute
		*/
		public function execute($type){
			if($type == "Flash"){
				$this->SetPath($type);
				$this->flash();
			}
			else if($type == "Unity3D"){
				$this->SetPath($type);
				$this->unity3D();
			}
			
			echo $this->code;
		}
		
		/**
		* Flash Code
		*/
		private function flash(){
			$this->code = "
			<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" 
				width=\"{$this->width}\" height=\"{$this->height}\" id=\"FlashID\" title=\"{$this->title}\">
				<param name=\"movie\" value=\"{$this->path}\" />
				<param name=\"quality\" value=\"high\" />
				<param name=\"wmode\" value=\"opaque\" />
				<param name=\"swfversion\" value=\"9.0.45.0\" />
				<embed src=\"{$this->path}\" quality = \"high\" bgcolor=\"#ffffff\" width=\"{$this->width}\" height=\"{$this->height}\" name=\"{$this->title}\" type =\"application/x-shockwave-flash\" wmode=\"transparent\"
				pluginpage=\"http://www.macromedia.com/go/getflashplayer\">
				</embed>
			</object>
			\n";
		}
		
		/**
		* Unity3D Code
		*/
		private function unity3D(){
			$this->code = "
			<script type=\"text/javascript\">
			var uniObj = new UnityObject(\"http://media.moddb.com/images/articles/1/76/75303/2d-spaceshooter.unity3d\", \"{$this->title}\", \"{$this->width}\", \"{$this->height}\");
			uniObj.setAttribute(\"altHTML\", \"<a href='http://unity3d.com/unitywebplayer.html' title='Go to unity3d.com to install the Unity Web Player'>Install the Unity Web Player</a>\");
			uniObj.write();
			</script>
			";
		}
		
		/**
		* IFrame
		*/
		private function IFrame(){
			$this->code = "
				 
			";
		}
		
	}

?>