<?php 
/*===============================================================================
*  An open source application development framework for PHP 5.1.6 or newer    
* 
*  PhpIgnite file is to auto load default files
* @access public
* @Author          :         Sanjoy Dey
* @Modified By :          
* @Warning      :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed   :         PHP-ignite Team
* @Framework Version 1.0
* ================================================================================
*/


/*
* ------------------------------------------------------
*  Define the Phpignite Version
* ------------------------------------------------------
*/
define('PI_VERSION', '1.0');

/*
* ------------------------------------------------------
*  Load the global Page
* ------------------------------------------------------
*/
require(PI_BASEPATH.'/common/PI_common_loader'.EXT);

$OBJ_LOADER = "";

$default_files = array('uri','profiler');



//$URI = load_file('uri','common');
$OBJ_LOADER = load_file($default_files,'common');

$CONFIG = load_file('config','configs');
$AUTOLOAD = load_file('autoload','configs');

// Load the PI controller class
require PI_BASEPATH.'/loader/PI_Loader'.EXT;

$defaultController = $CONFIG['PI_config']['GLOBAL_VAR']["default_controller"];
$base_url = $CONFIG['PI_config']['GLOBAL_VAR']["base_path"];
$encrypt_key = $CONFIG['PI_config']['GLOBAL_VAR']['encryption_key'];

/*
* ------------------------------------------------------
*  Define the Phpignite Encryption Key ID
* ------------------------------------------------------
*/
if(!empty($encrypt_key) ) {
        define('PI_ENCRYPT_KEY',$encrypt_key);
}

$site_url = $OBJ_LOADER[0]->site_url($base_url);

$url_string = $OBJ_LOADER[0]->urisegment('1');

if(empty($url_string)) {
         $OBJ_LOADER[0]->redirect($defaultController."/index");
}
/* */
$OBJ_LOADER[0]->urlstucture();

