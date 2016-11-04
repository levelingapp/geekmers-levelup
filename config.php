<?php
/**
* @author Luis Vazquez
* Date : 05/11/2012
* Config File: 	The purpose of this class is to Manage the LevelUp_Framework.
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/

/**
* Make sure to change this variable to false when the web site is uploaded
*/
$isLocalHost = false;

define("DS", DIRECTORY_SEPARATOR);
if($isLocalHost == true){
	
	define("PATH", "/geekmers2/");

}
else{
	$path = "http://".$_SERVER['SERVER_NAME'];
	define("PATH", "{$path}/");
}


/**
* This Function will auto load all classes that are on the Framework and will include their respective file where are locate them
* The purpose is to not include with require once everytime.
*/
function __autoload($class_name){

	$fileName = $class_name . ".php";
	
	//$fileName2 = lcfirst($fileName);
	
	//echo "<h1>" . $fileName . "</h1>";
	$fileName2 = substr($fileName, 0, 1);
	$fileName2 = strtolower($fileName2);
	$fileName2 = $fileName2 . substr($fileName,1) ;
	//echo "<h2>" . $fileName2 . "</h2>"; 
	
	$path1 = dirname(__FILE__) . DS . "levelUp_Framework". DS . $fileName;					//read classes from the same folder
	$path2 = dirname(__FILE__) . DS . "application". DS . "controller" . DS . $fileName2;	//goes to controller folder
	$path3 = dirname(__FILE__) . DS . "application". DS . "model" . DS . $fileName;			//goes to model folder
	
	/*
	echo "Path1: " . $path1 . "<br />";
	echo "Path2: " . $path2 . "<br />";
	echo "Path3: " . $path3 . "<br />";
	*/
	
	//Check if exists class
	if(file_exists($path1)){
		//echo "Required1: " . $path1 . "<br />";
		require_once($path1);
		
	}
	else if (file_exists($path2)){
		//echo "Required2: " . $path2 . "<br />";
		require_once($path2);
	}
	else if (file_exists($path3)){
		//echo "Required3: " . $path3 . "<br />";
		require_once($path3);
	}

}


/**
* Redirect URL when doesn't have a slash at the end /
*/
	$actual_link = "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
	$urlLink = $_SERVER[REQUEST_URI];
	$lastChar = $urlLink[strlen($urlLink)-1];

	if($lastChar != '/'){
		Header( "HTTP/1.1 301 Moved Permanently" );
		Header( "Location: {$actual_link}/" );
	}



?>