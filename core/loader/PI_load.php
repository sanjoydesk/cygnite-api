<?php 
/*
 * ===========================================================================
 *  An open source application development framework for PHP 5.1.6 or newer    
 * 
 * Load class is to load requested database and view files
 * @access public
 * @Author          :         Sanjoy Dey
 * @Modified By :          
 * @Warning      :         Any changes in this file can cause abnormal behaviour of the framework
 * @Developed   :         PHP-ignite Team
 * ===========================================================================
 */
class load {
                    
                      var $helper = NULL;
    
                    /*
                    * This function is to load requested model file
                    * @param string (model name)
                    *
                    */
                     function model($model_name=""){
                         $directory = "";
                        $directory = APPPATH."model/";

                                if(file_exists($directory.$model_name.EXT)) {
                                         require_once($directory.$model_name.EXT);
                                         return $model_name = new $model_name();
                                } else { throw new ErrorException("Unable to load Requested file ".$model_name.EXT); }
                     }
                     
                    /*
                    * This function is to load requested view file
                    * @param string (view name)
                    *
                    */
                     function presenter($view_name ="",$arrValues=array()){

                        $directory = APPPATH.'views/';
                        if(file_exists($directory.$view_name.EXT)) { 
                                 if(is_array($arrValues)) {
                                    extract($arrValues);
                                }
                             require_once($directory.$view_name.EXT);
                        } else { throw new ErrorException("Unable to load Requested file ".$view_name.EXT); }

                     }
                     
                     /*
                    *  Load Helper file
                    * 
                    * 
                    */
                     function load_library($file_name = "",$prefix = "PI_") {
                         
                         $directory = "";
                        $directory = PI_BASEPATH."/library/";
                        
                                if(file_exists($directory.$prefix.$file_name.EXT)) {
                                         require_once($directory.$prefix.$file_name.EXT);
                                         if($file_name == "encrypt" AND defined('PI_ENCRYPT_KEY')) {
                                                return new $file_name(PI_ENCRYPT_KEY);
                                         } else {
                                             return new $file_name();
                                        }                                         
                                } else { throw new ErrorException("Unable to load Requested file ".$file_name.EXT); }
                         
                     }
                     /* 
                     *  Load Library file
                     * 
                     */
                     
                     function load_helper($file_name = "",$prefix = "PI_") {
                        $directory = "";
                        $directory = PI_BASEPATH."/helpers/";
                        
                                if(file_exists($directory.$prefix.$file_name.EXT)) {
                                         require_once($directory.$prefix.$file_name.EXT);
                                } else { throw new ErrorException("Unable to load Requested file ".$file_name.EXT); }
                        unset($file_name);
                     }
                     /*
                      *  This function is to load file by default
                      * 
                      * 
                      */
                     public function _loaded_obj() {
                         //spl_autoload_register();                         
                            include_once(PI_BASEPATH.'/loader/PhpIgnite'.EXT);       
                            $this->PI =& get_object();
                            return $this->PI;
                     }
                     
}