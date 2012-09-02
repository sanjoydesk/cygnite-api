<?php
/*
*=========================================================================
*  An open source rapid application development framework for PHP 5.1.6 or newer    
* 
* Global Configuration Settings
* config.php 
* Set all configuration variables
*
* @access	                    public
* @param                              $PI_config array
* @Author                  :         Sanjoy Dey
* @Modified By         :          
* @Created Date      :         08-05-2012
* @Modified Date   :          06-08-2012
* @Warning            :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed By   :         PHP-ignite Team
*=========================================================================
*/


$PI_config = array();


return $PI_config = array(
                                  /*
                                  * Set Database Configuration
                                  * To connect Multiple database connection use db2,db3.... etc 
                                  * @prototype set database host_name
                                  * @prototype set database username
                                  * @prototype set database password
                                  * @prototype set database name
                                  * @prototype set database prefix
                                  * @prototype set database type
                                  * @prototype set database persistance connection TRUE or FALSE
                                  */
                                  'DB_CONFIG' => array(
                                                                          'db1' =>array( 
                                                                                                                    'host_name' => 'localhost',
                                                                                                                    'username'  => 'root',
                                                                                                                    'password'  => '',
                                                                                                                    'dbname'    => 'phpigniter',
                                                                                                                    'dbprefix'  => '',
                                                                                                                    'dbtype'    => 'mysql',
                                                                                                                    'pconnection' =>FALSE
                                                                              )
                                                                             /*,'db2' => array(
                                                                                                                    'host_name' => 'localhost',
                                                                                                                    'username'  => 'root',
                                                                                                                    'password'  => '',
                                                                                                                    'dbname'    => 'test',
                                                                                                                    'dbprefix'  => '',
                                                                                                                    'dbtype'    => 'mysql',
                                                                                                                    'pconnection' =>FALSE                                                                                  
                                                                              )  */
                                  ),
                                  /*
                                  * Set Global Variables as array
                                  * @prototype set base_path
                                  * @prototype set default_controller
                                  * @prototype set encryption key for encryption library
                                  * @prototype enable profiling TRUE or FALSE
                                  */
                                  'GLOBAL_VAR' => array(
                                                                                'base_path'  => 'http://localhost/phpignite/',
                                                                                'default_controller' => 'welcome',
                                                                                'encryption_key' => 'phpignite-sha1',
                                                                                'enable_profiling' => TRUE
                                  )
);
/* End of the config.php*/