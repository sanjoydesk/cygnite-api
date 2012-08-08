<?php
/* ========================================================= */
/* An open source application development framework for PHP 5.1.6 or newer
 *
 * LoadGlobal Config Class
 *
 * @package		PHPIgnite
 * @author		Mr. Sanjoy Dey
 * @copyright 	Copyright (c) .........
 * @license
 * @since		Version 1.0
 * @filesource
 */
/* ========================================================= */



Abstract class LoadGlobalCofig {

            public static function base_url($url){
                 $baseurl= "http://".$_SERVER['HTTP_HOST']."/smarty/application/spark/".$url;
                 return $baseurl;
            }

            public static function show($resultArray){
                 echo "<pre>";
                  print_r($resultArray);exit;
            }

            public static function flashMsg($flash_msg){
                    return $flash_msg;
            }

            public static function chkIsLoggedin() {

                if($_SESSION['username'] == "") {
                            //$url = "http://".$_SERVER['HTTP_HOST'];
                           redirect("login/index");
                    } else {
                           return "loggedin";
                }
            }

            public static function redirect($url="") {
                    $hostUrl = "http://".$_SERVER['HTTP_HOST']."/smarty/application/spark/";
                    header("Location: ".$hostUrl.$url);
            }

            public static function getCPAGE_URL($url="") {
                     return $url;
            }


}


/* ========================================================= */
/*
 * My framework Class
 * This is the platform-independent base Active Record implementation class.
 *
 *
 *
 *
 *
 */
/* ========================================================= */

class myFramework extends load{

   var $load=NULL;
   var $frame=NULL;

   function __construct(){
      /*$rootDir = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/configs/classess/";
       $rootDirectory = str_replace('/', '\\', $rootDir);
       require($rootDirectory."load.php"); */
       $this->load = new load();
      return $this;
   }


}

/* ========================================================= */
/*
 * Load Class used to load model and views
 * This is the platform-independent base implementation class.
 *
 *
 *
 *
 *
 */
/* ========================================================= */

class load {

     var  $modelOBJ=NULL;
     private $modelClass;
     //=========================================================//
     function __construct() {

     }
     //=========================================================//
    /*
    * Model function used to load model
    * @access     public
    * @param      filename
    * @param      array
    */
       public function model($modelname=""){

        $directory = $_SERVER['DOCUMENT_ROOT']."phpigniter/php/model/";
        $rtDirectory = str_replace('/', '\\', $directory);//echo $rtDirectory.$modelname.".php";

         if(file_exists($rtDirectory.$modelname.".php")) {
             require_once($rtDirectory.$modelname.".php");
             return  new $modelname();
       } else {
            echo "Model File Doesn't exists!!";
        }
   }
//=========================================================//

        /* This function is used for opening Php files
        * View function used to load view
        * @access     public
        * @param      filename
        * @param      array
        */
     function view($viewname="",$arrResult=array()){

           $directory = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/views/";
           $directory = str_replace('/', '\\', $directory);

        if(file_exists($directory.$viewname.".php")) {
            if(is_array($arrResult)) {
                extract($arrResult);
            }
            require_once($directory.$viewname.".php");

        } else {
            echo "View File Doesn't exists!!";
        }
    }

        /* This function is used for opening Php files
        * Smartyview function used to load template view file
        * @access     public
        * @param      filename
        * @param      array
        */
        function smartyview($viewname="",$data=array()){

            $directory = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/templates/";
            $directory = str_replace('/', '\\', $directory);

            if(file_exists($directory.$viewname.".tpl")) {
                //require_once($directory.$viewname.".tpl");

                if(is_array($data)) {
                    //extract($data);
                    $smarty = $this->initializeSmarty();
                    $smarty->assign('data',$data);
                    return $viewname;
                }
            } else {
                echo "View File Doesn't exists!!";
            }
        }
        public function getTemplateView($viewname="") {
            /*$directory = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/templates/";
            $directory = str_replace('/', '\\', $directory);
            $tplSmarty = $this->initializeSmarty();
            $tplSmarty->assign('tplviewpage',$viewname);
            $tplSmarty->display('spark.tpl');
            */
            $viewname = $viewname;
            $directory = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/views/";
            $directory = str_replace('/', '\\', $directory);
            include_once($directory.'template.php');
        }

        private function initializeSmarty() {
            require_once('../../libs/Smarty.class.php');
            $smarty = new Smarty;
            $smarty->debugging = true;
            $smarty->caching = true;
            $smarty->cache_lifetime = 120;
            return $smarty;
        }

        public function postValue($formPost="") {
            if(isset($_POST[$formPost])) {
                $postValues = $_POST[$formPost];
                if(is_array($postValues)) {
                    return $postValues;
                } else {
                    return $postValues;
                }
            }
        }

}

//=====================END of the Class Load================================//



/* ========================================================= */
/*
 * Load Class used to select datas and insert update and delete
 * This is the platform-independent base implementation class.
 *
 *
 *
 *
 *
 */
/* ========================================================= */


class modelFramework extends database{

               var $db=NULL;
               //=====================================================//
                /**
                * Constructor function
                * Creating Object for database class
                *
                * @access	public
                * @return	db object
                *
                */
               function __construct(){
                  $this->db = new database();
                  return $this->db;
               }

            }

            class database {

                 private $selectQuery;
                 private $from_where;
                 private $field_where;
                 var $dbConn=NULL;
                 //=====================================================//

                 /**
                * Constructor function
                * Loading Config intems and connecting Database
                *
                *
                */

                 function __construct(){
                            $rootDir = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/configs/";
                            $rootDirectory = str_replace('/', '\\', $rootDir);
                            require($rootDirectory."\includes\config.php");
                            $this->dbConnection($config);
                 }
                 //=====================================================

                 /**
                * DB Connection FUnction is to connect with Database by provided Settings
                *
                *
                * @access	public
                * @param	string
                * @return	none
                */

                 function dbConnection($connection = array()) {
                           $this->dbConn = mysql_connect($connection['host_name'],$connection['username'],$connection['password']);
                           mysql_select_db($connection['dbname'], $this->dbConn);
                 }

               //=====================================================

                /**
                * Find Function to selecting Table columns
                *
                * Generates the SELECT portion of the query
                *
                * @access	public
                * @param	string
                * @return	object
                */
                 public function find($query)
                {
                            $this->selectQuery = $query;
                           return $this;
                }

                //=====================================================
                /* Where
                *
                * Generates the WHERE portion of the query. Separates
                * multiple calls with AND
                *
                * @access	public
                * @param	column name
                * @param	value
                * @return	object
                */
                public function where($filedName="",$where="")
                {
                    /*
                    if(!empty($this->from_where)) {
                            $this->field_where .= "AND";

                    }
                    */
                    if(is_array($filedName)) {

                        $qry = "";
                      $arrCount = count($filedName);
                       $i = 0;
                    foreach($filedName as $key=>$value) {

                        $this->from_where .= " `".$key."` "."="." '".$value."'"." ";
                        $this->from_where .=  ($i < $arrCount-1) ? ' AND ' : '';

                        $i++;
                    }

                        return $this;
                    } else  {

                        $this->field_where = $filedName;
                        $this->from_where = $where;
                        return $this;

                    }


                }


                //=====================================================

                /**
                * Get_details Function to performing All details from Database
                *
                * Generates the SELECT portion of the query
                *
                * @access	public
                * @param	string
                * @return	object
                */
                public function get_details($tblname)
                {
                //   print_r($this->from_where);


                    $searchedKey = strpos($this->from_where, "AND");
                    $data = array();
                    if($searchedKey === false) {

                                 if(is_string($this->from_where)) {
                                     $field_value = "'".$this->from_where."'";
                                 }
                                    if(is_int($this->from_where)) {
                                         $field_value = $this->from_where;

                                    }
                                    $qry = "";

                                         if($this->field_where !="") {
                                             $where = "`".$this->field_where."`" ."="."'".$this->from_where."'";
                                          } else {
                                              $where = " 1=1";

                                         }
                             $qry = "Select ".$this->selectQuery." "."from"." ".$tblname." where ".$where;

                            $resultArray = mysql_query($qry) or debug_query($qry);
                                while($row = mysql_fetch_array($resultArray,MYSQL_ASSOC))  {
                                      $data[] = $row;
                                }
                         return $data;

                    } else {

                              if(is_string($this->from_where)) { $field_value = "'".$this->from_where."'"; }
                              if(is_int($this->from_where)) { $field_value = $this->from_where; }
                              $qry = "";
                             if($this->from_where !="") { $where = $this->from_where; } else { $where = " 1=1";}
                             $qry = "Select ".$this->selectQuery." "."from"." ".$tblname." where ".$where;

                            $resultArray = mysql_query($qry) or debug_query($qry);
                                    while($row = mysql_fetch_array($resultArray,MYSQL_ASSOC))  {
                                          $data[] = $row;
                                    }
                         return $data;
                    }

                }

                //=====================================================

                /**
                * Insert Function to Insert Values in Database
                * Insert
                *
                * Compiles an insert string and runs the query
                *
                * @access	public
                * @param	string	the table to retrieve the results from
                * @param	array	an associative array of insert values
                * @return	object
                */
                public function insert($tblName,$data,$exclude = array()) {

                            $fields = $values = array();
                            if( !is_array($exclude) ) $exclude = array($exclude);
                            foreach( array_keys($data) as $key ) {
                                    if( !in_array($key, $exclude) ) {
                                        $fields[] = "`$key`";
                                        $values[] = "'" . mysql_real_escape_string($data[$key]) . "'";
                                }
                            }
                            $fields = implode(",", $fields);
                            $values = implode(",", $values);
                            $bld_qry = "insert into `$tblName`($fields) values"." ($values)";
                            mysql_query($bld_qry) or debug_query($bld_qry);
                          return mysql_insert_id();
                }

                //=====================================================
                /**
                * Update
                *
                * Compiles an update string and runs the query
                *
                * @access	public
                * @param	string	the table to retrieve the results from
                * @param	array	an associative array of update values
                * @param	mixed	the where clause
                * @return	object
                */
                public function update($tblName,$data=array()) {

                    $qry = "";
                    $qry .="Update ".$tblName." set ";
                    $arrCount = count($data);
                       $i = 0;
                    foreach($data as $key=>$value) {

                        $qry .= " `".$key."` "."="." '".$value."'"." ";
                        $qry .=  ($i < $arrCount-1) ? ',' : '';

                        $i++;
                    }
                    $qry .=" where "."`".$this->field_where."`"." = " .$this->from_where;
                    $return = mysql_query($qry) or debug_query($qry);
                    return $return;
                }


                 //=====================================================
                /**
                * Delete function
                *
                * Delete rows from the table and runs the query
                *
                * @access	public
                * @param	string	the table to retrieve the results from
                * @return	object
                */
                 public function delete($tblName) {
                    $qry = "";
                    $qry .="Delete from ".$tblName." ";
                    $qry .=" where "."`".$this->field_where."`"." = " .$this->from_where;
                    $return = mysql_query($qry) or debug_query($qry);
                    return $return;
                }

                  //=====================================================
                /**
                * Affected Rows function
                *
                * Affected rows Function to get No of rows Affected
                *
                * @access	public
                */
                public function affected_rows() {
                        echo mysql_affected_rows();exit;
                }

                //=====================================================
}

        //=======================Database Class End==============================//
        /*
        * Global Functions
        *
        */

        //error_reporting(0);

        /*
         * Show function
         * @access     public
         * @param     array
         */
        function show($resultArray){
              echo "<pre>";
              print_r($resultArray);exit;
        }

        //=====================================================
        /**
        * Url Structure FUnction is to make mvc structure url
        *
        * @access	public
        *
        */

        function urlstucture() {

                    $uristring = explode('/',($_SERVER['REQUEST_URI']));
                    $indexCount = array_search('index.php',$uristring);
                    $rootDir = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/";
                    $rootDirectory = str_replace('/', '\\', $rootDir);
                    $controller = "";
                    if(file_exists($rootDirectory."maincontroller/".@$uristring[$indexCount+1].".php")) {
                          require_once("maincontroller/".@$uristring[$indexCount+1].".php");

                    $controller = new $uristring[$indexCount+1]();
                     } else {

                     }
                    call_user_func_array(array(@$controller, @$uristring[$indexCount+2]), (array_slice($uristring,$indexCount+3)));
            }
        //=====================================================
        /**
        * Urlsegment Function is to get uri Segment of the url
        *
        * @access	public
        * @param                     url
        */
             function urisegment($uri="") {

                    $uristring = explode('/',($_SERVER['REQUEST_URI']));
                    $indexCount = array_search('index.php',$uristring);
                    try {
                        if($uri !="") {  return @$uristring[$indexCount+$uri]; }
                    } catch (Exception $ex) {
                        $ex->getMessage();
                    }
            }
        //=====================================================

        /**
        * Debug Query Function is to debug query and show it error exists
        *
        * @access	public
        * @param                     Query
        *@return                       Mysql Error Output
        */
           function debug_query($query){

                    $output = mysql_query($query) or die('
                    <div style="border:1px solid #D8000C;width:auto;height:auto;background: #FFBABA;"><span style="border:1px solid #D8000C;background-color: #FFBABA;"><h1 style="color: red;">Ooopsss!!! MySQL Error:</h1>
                    <h3>Query:</h3>
                    <span style="color:#D8000C;background: #FFBABA;"><pre>' . htmlentities($query) . '</pre></span>
                    <h3>MySQL Error:</h3>' . mysql_error() . '
                    </span></div>');
            return $output;
           }
        //=====================================================

        /**
        * Redirect Function is to redirect page
        *
        * @access	public
        * @param                     redirect url
        *@return                       none
        */
           function redirect($redirecturl="") {
                   $hostUrl = "http://".$_SERVER['HTTP_HOST']."/smarty/application/spark/index.php/";
                    header("Location: ".$hostUrl.$redirecturl);

           }
       //=====================================================//

        /**
        * Base url function is to get base url of the project
        *
        * @access	public
        * @param                     none
        *@return                      return baseurl
        */

           function base_url() {
                    $rootDir = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/configs/";
                    $rootDirectory = str_replace('/', '\\', $rootDir);
                    require($rootDirectory."\includes\config.php");

           return $config['base_url'];

           }
         //=====================================================//

           
/* Encryption Process */
           
/*
* This function is to encrypt the string
* @param string
* @return encoded string
*
*/

  if(!function_exists("encrypt")) {
        function encrypt_($string) {
           $encoded_string = base64_encode($string);
            if ($this->_mcrypt_exists === TRUE)
            {

            }
        }
  }

    function _encrypt() {


    }


    define('SALT', 'Encryption Library');

    function encrypt($text)
    {

        $mcrypt_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $mcrypt_string = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB,$mcrypt_iv));
        return trim($mcrypt_string);
    }

    function decrypt($text)
    {
        $mcrypt_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB,$mcrypt_iv);
        return trim($decrypted_string);
    }


    echo $encryptedmessage = encrypt("Encrypted String"); echo "<br>";
    echo decrypt($encryptedmessage)."<br><hr>";



/* End of file globalconfigClass.php.php */
/* Location: ./spark/configs/classes/globalconfigClass.php.php */