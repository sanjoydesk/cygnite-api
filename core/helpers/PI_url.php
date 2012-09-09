<?php
/*
 * ===========================================================================
 *  An open source application development framework for PHP 5.1.6 or newer    
 * 
 * 
 * @access          :  public   
 * @Author          :  Sanjoy Dey
 * @Modified By     :        
 * @Warning         :  Any changes in this file can cause abnormal behaviour of the framework
 * @Developed       :  PHP-ignite Team
 * ===========================================================================
 */

                    
        
/**
        * Header Redirect
        *
        * @access	public
        * @param	string	the URL
        * @param	string	the method: location or redirect
        * @return	string
        */
if(!function_exists('redirect()')) {
        function redirect($uri = '', $type = 'location', $http_response_code = 302)
        {
            
            if ( ! preg_match('#^https?://#i', $uri))
            {
                $uri = $uri;
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
}
        //=====================================================
        /*
        * This Function is to get uri Segment of the url
        *
        * @access public
        * @param  int
        * @return string
        */
       if(!function_exists('request_uri()')) {
                function request_uri_segment($uri="") {
                        $index_page = 'index.php';
                        $uristring = "";
                        $uristring = explode('/',($_SERVER['REQUEST_URI']));
                        $indexCount = array_search($index_page,$uristring);
                            try {
                                if($uri !="") {  return @$uristring[$indexCount+$uri]; }
                            } catch (Exception $ex) {
                                $ex->getMessage();
                            }
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
