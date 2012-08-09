<?php 
/*===========================================================================
*  An open source application development framework for PHP 5.1.6 or newer    
* 
* This file is used to load common files of  PI Framework
* @param filename(string)
* @param directory name (string)
* @param file prefix
* @access public
* @Author          :         Sanjoy Dey
* @Modified By :         Sanjoy Dey
*@Modified Portion : Checked for is classname is array  
* @Warning      :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed   :         PHP-ignite Team
* ============================================================================
*/

    function load_file($class, $directory = 'common', $prefix = 'PI_') 
    {

         $directories = array(PI_BASEPATH, APPPATH);        
         $_has_classes = "";

                     foreach($directories as $dir_path) {

                                     if($dir_path == "core") { 
                                         
                                         $class_name = "";                                         
                                         //Check whether class name given as array or not 
                                         if(is_array($class)) { 
                                                   for($i=0;$i <count($class);$i++){
                                                          if (file_exists($dir_path."/".$directory.'/'.$prefix.$class[$i].EXT))   {
                                                                   $class_name = $prefix.$class[$i];
                                                                         require($dir_path."/".$directory.'/'.$prefix.$class[$i].EXT);
                                                                  $_has_classes[] = new $class_name();
                                                         }
                                                   }
                                         }  else {                   
                                                         if (file_exists($dir_path."/".$directory.'/'.$prefix.$class.EXT))   {
                                                                 $class_name = $prefix.$class;
                                                                        require($dir_path."/".$directory.'/'.$prefix.$class.EXT);
                                                                    $_has_classes = new $class_name();
                                                                break;
                                                         }
                                         }
                                     }

                                     if($dir_path == APPPATH){ 
                                                 if (file_exists($dir_path.$directory.'/'.$class.EXT))  {
                                                      require($dir_path.$directory.'/'.$class.EXT);          
                                                      $_has_classes['PI_config'] = $PI_config;
                                                     break;
                                                 }
                                     }
                     }
         return $_has_classes;
}
/*
 * Unset All object which unused
 * @param array()
 * @unset objects
 */
 function unsetobjects($objArray = array())
{
       foreach($objArray as $objvars) {              
              unset($objvars);
       }
}