<?php

/* =======================================================================*/
/* An open source application development framework for PHP 5.1.6 or newer    
 *                                                                                                                                                 
 * Database Connection Class                                                                                                        
 *                                                                                                                                                 
 * @package		PHP-ignite                                                                      
 * @author		Mr. Sanjoy Dey                                                            
 * @copyright 	Copyright (c)     .........                                                                               
 * @license                                                                                                                              
 * @since		Version 1.0                                                                   
 * @filesource                       
 * 
 */                                                                                                                                              
/* =======================================================================*/
abstract class DBConnectionManager 
{  
    private $error =NULL,$errno= NULL;
    var $dbConn = NULL;
        
        function db_connect() 
        { 
                    if(file_exists(APPPATH.'/configs/config'.EXT)) {
                        $DBCONFIG = array();
                                
                                            $DBCONFIG = load_file('config','configs');  
                                            $db_config = $DBCONFIG['PI_config']['DB_CONFIG'];
                                             if(is_array($db_config)) {
                                                 $i = 1;
                                                   foreach($db_config as $row) { 
                                                              if($row['dbtype'] == 'mysql' || $row['dbtype'] == 'MYSQL' || $row['dbtype'] == 'mysqli') {
                                                                  
                                                                      $this->dbConn = mysql_connect($row['host_name'],$row['username'],$row['password']) or die("Database Connection Error");
                                                                      mysql_select_db($row['dbname'], $this->dbConn) or die('Please check the Database name');  
                                                                      $i++;
                                                                      //mysql_close();
                                                                     // unset($this->dbConn);
                                                              }        
                                                   }
                                             } else {   
                                                        if($db_config['dbtype'] == "mysql" || $row['dbtype'] == 'MYSQL') {
                                                            try {
                                                                    $this->dbConn = mysql_connect($db_config['host_name'],$db_config['username'],$db_config['password']) or die("Database Connection Error");
                                                                    mysql_select_db($db_config['dbname'], $this->dbConn);  
                                                                   // mysql_close();
                                                                 //   unset($this->dbConn);
                                                                
                                                            } catch(Exception $error) {                                                                     
                                                                    throw new Exception($error->getMessage());
                                                            }
                                                       }   
                                             }
                                                                    
                    } else {
                                   throw new Exception("Cannot Load Database Configuration File");
                    }

        }
        
        function close_connection() {
            if(!@mysql_close($this->dbConn)){
                     $this->_throwDBException("Connection close failed !!");
            } else {
                return @mysql_close($this->dbConn);
            }
            
            
       }
            
       
        function _throwDBException($msg='') 
        {
               
	if($this->dbConn > 0){
		$this->error= @mysql_error($this->dbConn);
		$this->errno=@mysql_errno($this->dbConn);
	}
	else{
		$this->error=mysql_error();
		$this->errno=mysql_errno();
	
                      echo  '<div style="border:1px solid #D8000C;width:auto;height:auto;">
                        <span style="border:1px solid #D8000C;"><h3 style="color: red;">Database Error</h3>
                        <h3>Message:</h3>
                        <span style="color:#D8000C;background: #FFBABA;"><pre>'.$msg.'</pre></span>
                        <h3>MySQL Error:</h3>'.$this->error.'                       
                        </span></div>';
                  }
	
            }
            
       function __destruct() {
            unset($this->dbConn);
      }
}


class DatabaseFactory
{
            // The factory function takes as an argument the
            // name of the class to produce
            public static function getInstance($driver)
            {
                // Attempt to include the the file containing the class
                // (not necessary if you use a custom autoloader)
                if(include_once(dirname(__FILE__).'/drivers/database_'.$driver.'.php'))
                {
                        // Build the name of the class, instantiate, and return
                        $driver_class = 'Database_'.$driver;
                        return new $driver_class;
                }
                else
                {
                      throw new Exception('Database driver not found');
                }
            }
}