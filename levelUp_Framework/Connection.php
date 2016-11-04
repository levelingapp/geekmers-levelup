<?php
/**
* @author Luis Vazquez
* Date : 06/17/2011
* Connection class:     The purpose of this class is to connect to the host
*                        and select a data base.
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class Connection{
    private $host = "x"; // "localhost" in PDO is so slow we need to change it to 127.0.0.1
    private $user = "db";
    private $password = "@";
    private $dbname = "db";
    protected static $db;

	
    /**
    * Open connection and select the data base
    */
    public function open_connection(){


		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		
	  
        try{
            self::$db = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->user, $this->password, $options);
        }
        catch(PDOException $ex){

            die("Failed to connect to the database: " . $ex->getMessage());
        }
       
        // This statement configures PDO to throw an exception when it encounters
        // an error.  This allows us to use try/catch blocks to trap database errors.
		self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       

		self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
     
        if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()){
            
			if(!function_exists('undo_magic_quotes_gpc')){
				function undo_magic_quotes_gpc(&$array){
					foreach($array as &$value){
						if(is_array($value)){
							undo_magic_quotes_gpc($value);
						}else{
							$value = stripslashes($value);
						}
					}
				}
			}
           
            undo_magic_quotes_gpc($_POST);
            undo_magic_quotes_gpc($_GET);
            undo_magic_quotes_gpc($_COOKIE);
        }
       
        
    }
   
    /**
    * Close and unset connection
    * Make sure to call this after each closing tag </body>
    */
    public function close_connection(){
        $this->db = null;
    }
   
    
}
?>