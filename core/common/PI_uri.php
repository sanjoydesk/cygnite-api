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
    
        /**
        * Header Redirect
        *
        * @access	public
        * @param	string	the URL
        * @param	string	the method: location or redirect
        * @return	string
        */

        function redirect($uri = '', $method = 'location', $http_response_code = 302)
        {
            
            if ( ! preg_match('#^https?://#i', $uri))
            {
                $uri = $this->site_url($uri);
            }

            switch($method)
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
                $indexCount = array_search('index.php',$uristring);
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
                    $indexCount = array_search('index.php',$uristring);
                    
                    $controller = "";
                    if(file_exists(APPPATH."controllers/".$uristring[$indexCount+1].EXT)) {
                                  require_once(APPPATH."controllers/".$uristring[$indexCount+1].EXT);
                                 $controller = new $uristring[$indexCount+1]();
                     }                     
                     if(empty($indexCount) AND empty($controller)) {     
                                require_once(APPPATH."controllers/".$defaultController.EXT);
                               $controller = new $defaultController();
                               call_user_func_array(array($controller,'index'), (array_slice($uristring,$indexCount+1)));
                               unset($controller);                           
                    } 
                      if(!empty($controller)) {
                                    if($uristring[$indexCount+2] == "") {
                                            $uristring[$indexCount+2] = 'index';
                                    }
                                 call_user_func_array(array($controller, $uristring[$indexCount+2]), (array_slice($uristring,$indexCount+3)));
                                 unset($controller);
                     } else{
                                $this->redirect('index.php/'.$defaultController.'/index');
                   }
            }

}
?>