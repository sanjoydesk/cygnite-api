<?php 
/*
* =============================================================================
*  An open source application development framework for PHP 5.1.6 or newer    
* 
*  PI_URI class is to load uri functionalities
* @access public
* @Author          :         Sanjoy Dey
* @Modified By :          
* @Warning      :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed   :         PHP-ignite Team
* =============================================================================
*/
//namespace PI_uri;

class PI_uri {
    
         private $index_page = "index.php";
         private $default_method = "index";
    
        /**
        * Header Redirect
        *
        * @access	public
        * @param	string	the URL
        * @param	string	the method: location or redirect
        * @return	string
        */

        function redirect($uri = '', $type = 'location', $http_response_code = 302)
        {
            
            if ( ! preg_match('#^https?://#i', $uri))
            {
                $uri = $this->site_url($uri);
            }

            switch($type)
            {
                case 'refresh'     : header("Refresh:0;url=".$uri);
                                                break;
                default              : header("Location: ".$uri, TRUE, $http_response_code);
                                               break;
            }
            exit;
        }

        
        function site_url($uri = '') {
                    return $uri;
       }
        
        
        //=====================================================
        /*
        * This Function is to get uri Segment of the url
        *
        * @access public
        * @param  int
        * @return string
        */

        function urisegment($uri="") {
                $uristring = "";
                $uristring = explode('/',($_SERVER['REQUEST_URI']));
                $indexCount = array_search($this->index_page,$uristring);
                    try {
                        if($uri !="") {  return @$uristring[$indexCount+$uri]; }
                    } catch (Exception $ex) {
                        $ex->getMessage();
                    }
        }

        

        /*
        * This Function is to encode the url
        *
        * @access public
        * @param  int
        * @return string
        */

        function url_encode() {




        }
        
       
        //=====================================================//
        /*
        * Url Structure Function is to make mvc structure url
        *
        * @access	public
        *
        */

        function urlstucture($defaultController="") 
        {          
                    $uristring = explode('/',($_SERVER['REQUEST_URI']));
                    $indexCount = array_search($this->index_page,$uristring);
                    
                    $_obj_controller = "";
                    if(file_exists(APPPATH."controllers/".$uristring[$indexCount+1].EXT)) {
                                  require_once(APPPATH."controllers/".$uristring[$indexCount+1].EXT);
                                 $_obj_controller = new $uristring[$indexCount+1]();
                     }                     
                     if(empty($indexCount) AND empty($_obj_controller)) {     
                                require_once(APPPATH."controllers/".$defaultController.EXT);
                               $_obj_controller = new $defaultController();
                               call_user_func_array(array($_obj_controller,$this->default_method), (array_slice($uristring,$indexCount+1)));
                               unset($_obj_controller);                           
                    } 
                      if(!empty($_obj_controller)) {
                                    if($uristring[$indexCount+2] == "") {
                                            $uristring[$indexCount+2] = $this->default_method;
                                    }
                                 call_user_func_array(array($_obj_controller, $uristring[$indexCount+2]), (array_slice($uristring,$indexCount+3)));
                                 unset($_obj_controller);
                     } else{ 
                                $this->redirect($this->index_page.'/'.$defaultController.'/'.$this->default_method);
                   }
            }
            /*
             *  This method is used to destroy the global variables of the class
             * @param variable
             * @param variable
             * 
             */
            function __destruct() {
                   unset($this->index_page);
                   unset($this->default_method);
            }
}