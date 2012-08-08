<?PHP
/*===============================================================================
*  An open source application development framework for PHP 5.1.6 or newer    
* 
*  This file is entry point of the framework. 
* @access public
* @Author          :         Sanjoy Dey
* @Modified By :          
* @Warning      :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed   :         PHP-ignite Team
* @Framework Version 1.0
* @ Define Application and system folder
* ================================================================================
*/



/*
 * 
 *  Define Directory Separator
 */
define('DS',DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * Core FOLDER NAME
 *---------------------------------------------------------------
 *
 */
$system_path = 'core';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 */
$application_folder = 'application';
            
/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */

// The PHP file extension
define('EXT', '.php');


// Path to the system folder
define('PI_BASEPATH', str_replace("\\", "/", $system_path));



// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(PI_BASEPATH, '/'), '/'), '/'));


//Name of the Root Directory 
define('ROOT_DIR', str_replace("/", "", rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/')));




if($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1") {    
   /*
    * ------------------------------------------------------
    *  Define the Environment
    * ------------------------------------------------------
    */
    define('ENVIRONMENT', 'development');
}



function file_extension($filename) { return end(explode(".", $filename)); } 

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
                error_reporting(E_ALL);
                //$globalloader =  dirname(__FILE__).DS.$system_path .DS."common".DS ;
		break;
	
		case 'testing':
		case 'production':
			    error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}
 


// Set the current directory correctly for CLI requests

	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';

	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}

// The path to the "application" folder
	if (is_dir($application_folder))
	{
		define('APPPATH', $application_folder.'/');
	}
	else
	{
		if ( ! is_dir(PI_BASEPATH.$application_folder.'/'))
		{
			exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		}

		define('APPPATH', PI_BASEPATH.$application_folder.'/');
	}



require_once PI_BASEPATH.'/loader/PhpIgnite'.EXT;