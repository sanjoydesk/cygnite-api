<?php 
/*
* =============================================================================
*  An open source application development framework for PHP 5.1.6 or newer    
* 
*  PI_profiler class is to calculate memory consumption and time elapsed to load application
* @access public
* @Author          :         Sanjoy Dey
* @Modified By :          
* @Warning      :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed   :         PHP-ignite Team
* =============================================================================
*/

class profiler {
    
        /**
        * Profiler starting point
        *
        * @access	public
        * @param	string
        */

       public  function start_profiling() {
                     if(!defined('MEMORY_START_POINT') AND !defined('START_TIME')) {
                                 define('MEMORY_START_POINT', memory_get_usage());
                                 define('START_TIME', microtime(true));
                     }
        }
        
         /**
        * Profiler end point
        *
        * @access	public
        * @param	string
        */

       public function end_profiling() {            
                    print round(microtime(true) - START_TIME, 5). ' seconds';
                    print " &nbsp; &nbsp; &nbsp;Total memory - ".$this->memory_space_usage();          
        }
        
        /**
        *  Profiler end point
        *
        * @access	public
        * @param	string
        */

       public function memory_space_usage() {   
                   //memory_get_peak_usage();
                    return round(((memory_get_usage() - MEMORY_START_POINT) / 1024), 2). ' kB<br />';          
        }
        
        function __destruct() {
            
        }
        
}
?>