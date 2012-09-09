<?php 
/*
*=========================================================================
*  An open source application development framework for PHP 5.1.6 or newer    
* 
* PI_Loader.php 
* PI_Controller class 
* Inheriting load class and its properties
*
* @access	                   public
* @param                             $load, $db variable
* @Author                 :         Sanjoy Dey
* @Modified By        :          
* @Warning             :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed By    :         PHP-ignite Team
*=========================================================================
*/

require_once(PI_BASEPATH.'/loader/'.FRAMEWORK_PREFIX.'load'.EXT);
require_once(PI_BASEPATH.'/database/'.DATABASE_PREFIX.'model'.EXT);

class PI_Controller extends load{

           var $load=NULL;
           /** @var  */
          private static $instance;
          
            //=====================================================================
            /**
            * Constructor function
            * Creating Object for load class
            *
            * @access	public
            * @return	load class object
            *
            */
           function __construct(){ 
              // self::$object = $this;
               $this->load = new load();
              return $this->load;
           }
                     
            /**
            * Returns singleton instance with lazy instantiation.
            * @return 
            */
            public static function getInstance()
            {
                if (self::$instance === NULL) {
                self::$instance = new static;
                }
                return self::$instance;
            }
           
           function __destruct() {
               unset($this->load);
               unset($instance);
               unset($object);
           }
}

class PI_Model extends PI_Database {

               var $db=NULL;
               
               //====================================================================
                /**
                * Constructor function
                * Creating Object for database class
                *
                * @access	public
                * @return	db object
                *
                */
               function __construct(){                    
                  $this->db = new PI_Database();
                  return $this->db;
               }
               
               function __destruct() {
                   unset($this->db);
               }
               
}