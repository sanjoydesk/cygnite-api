<?php

/* =======================================================================*/
/* An open source application development framework for PHP 5.1.6 or newer    
 *                                                                                                                                                 
 * Database Model Class                                                                                                        
 *                                                                                                                                                 
 * @package		PHP-ignite                                                                      
 * @author		Mr. Sanjoy Dey                                                            
 * @copyright 	Copyright (c)     .........                                                                               
 * @license                                                                                                                              
 * @since		Version 1.0                                                                   
 * @filesource                       
 * @todo                                           Have to check for sql injection, group by, where in, mysql_array, mysql_object, distinct, like, having, aggregate functions, truncate , Join functions, Store Procedures etc.                                                                                              
 */                                                                                                                                              
/* =======================================================================*/


   class PI_Database {

             private $selectQuery = NULL,$from_where =NULL,$field_where = NULL,$field_where_in =NULL,$from_where_in =NULL,$limit_value =NULL;             
             var $dbConn=NULL;
           //=====================================================//

            /**
            * Constructor function
            * Loading Config items and connecting Database
            *
            *
            */

             function __construct(){                 
                         $CONFIG = load_file('config','configs');  
                        $this->dbConnection($CONFIG['PI_config']['DB_CONFIG']);
             }
             //=====================================================

            /*
            * DB Connection Function is to connect with Database by provided Settings
            *
            * @access	public
            * @param	string
            * @return	none
            */

             function dbConnection($connection = array()) {
                                  
                             switch($connection['dbtype']) {
                                             case 'mysql':
                                                                        $this->dbConn = mysql_connect($connection['host_name'],$connection['username'],$connection['password']) or die("Cannot Connect to Database");
                                                                        mysql_select_db($connection['dbname'], $this->dbConn);
                                                                        break;
                                             case 'mysqli': // to do
                                                                        break;
                                             case 'sqllite': 
                                                                        break;                       
                                             case 'oracle' : 

                                                                        break;
                                             case 'postgresql' : 

                                                                        break;
                             }                 
             }
             
             function close_connection() {
	if(!@mysql_close($this->dbConn)){
	           $this->_throwDBException("Connection close failed !!");
	} 
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
            public function find($query = "")
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
                        // Check whether value passed as array or not
                       if(is_array($filedName)) {
                           
                           /** @var $qry TYPE_NAME */
                                $qry = "";
                                $arrCount = count($filedName);
                                $i = 0;
                                    // create where condition with and if value is passed as array
                                    foreach($filedName as $key=>$value) {
                                        $this->from_where .= " `".$key."` "."="." '".$value."'"." ";
                                        $this->from_where .=  ($i < $arrCount-1) ? ' AND ' : '';
                                        $i++;
                                    }
                                   return $this;
                        } else {
                                    $this->field_where = $filedName;
                                    $this->from_where = $where;
                                   return $this;
                        }
            }

           //=====================================================
           /* Where In
           *
           * Generates the WHERE in portion of the query. Separates
           * multiple calls with AND
           *
           * @access	public
           * @param	column name
           * @param	value
           * @return	object
           */
           public function where_in($filedName="",$where="")
           {
                // Check whether value passed as array or not
               if(is_array($filedName)) {
                   /** @var $qry TYPE_NAME */
                   $qry = "";
                   $arrCount = count($filedName);
                   $i = 0;
                          //Create where in condition with and if value is passed as array
                       foreach($filedName as $key=>$value) {
                           $this->from_where_in .= " `".$key."` "."="." '".$value."'"." ";
                           $this->from_where_in .=  ($i < $arrCount-1) ? ' AND ' : '';
                           $i++;
                       }
               return $this;
               } else {
                       $this->field_where_in = $filedName;
                       $this->from_where_in = $where;
               return $this;
               }
           }
           //=====================================================
           /*
           * limit function to limit the database query
           * @access   public
           * @param    int
           * @return   object
           */
           public function limit($limit="",$offset="") {

               $this->limit_value = $limit;
               $this->offset_value = $offset;
               return $this;
           }

           //=====================================================
           /*
           * orderby function to make order for selected query
           * @access   public
           * @param    string
           * @param    string
           * @return   object
           */
           public function order_by($filed_name="",$order_type="") 
          {
               $this->field_name = $filed_name;
               $this->order_type = $order_type;
               return $this;
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
           public function get_details($tblname = "")
           {
               $limitWhere = "";
               $searchedKey = strpos($this->from_where, "AND");
               $data = array();
               if($searchedKey === false) {
                   if(is_string($this->from_where)) {
                       $field_value = "'".$this->from_where."'";
                   }
                       if(is_int($this->from_where)) {
                           $field_value = $this->from_where;
                       }

                           if($this->field_where !="") {
                               $where = "WHERE `".$this->field_where."`" ."="."'".$this->from_where."'";
                           } else {
                               $where = " ";
                           }
                               if($this->limit_value != ""  AND $this->offset_value != ""){
                                   $limitWhere = "LIMIT ".$this->limit_value.",".$this->offset_value."";
                               } else {
                                   $limitWhere = " ";
                               }
                            //@var qry as NULL
                           $qry = "";
                           $qry = "SELECT ".$this->selectQuery." "."FROM ".$tblname."".$where."".$limitWhere; // Build Select query
                   $resultArray = mysql_query($qry) or debug_query($qry);
               while($row = mysql_fetch_array($resultArray,MYSQL_ASSOC))  {
                   $data[] = $row;
               }
               return $data;

               } else {

                   if(is_string($this->from_where)) {
                       $field_value = "'".$this->from_where."'";
                   }
                       if(is_int($this->from_where)) {
                           $field_value = $this->from_where;
                       }
                           if($this->from_where !="") {
                               $where = $this->from_where;
                           } else {
                               $where = " 1=1";
                           }
                       $qry = "";
                       $qry = "SELECT ".$this->selectQuery." "."FROM "." ".$tblname." WHERE ".$where;

                   $resultArray = mysql_query($qry) or debug_query($qry);
                   while($row = mysql_fetch_array($resultArray,MYSQL_ASSOC))  {
                       $data[] = $row;
                   }
               return $data;
               }

           }

            //=====================================================

            /*
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
            public function insert($tblName = "",$data = array(),$exclude = array()) 
           {

                            $fields = $values = array();
                            if( !is_array($exclude) ) $exclude = array($exclude);
                                foreach(array_keys($data) as $key ) {
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
            public function update($tblName="",$data=array()) 
           {

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
             public function delete($tblName="") 
            {
                    $qry = "";
                    $qry .="Delete from ".$tblName." ";
                    $qry .=" where "."`".$this->field_where."`"." = " .$this->from_where;
                    $return = mysql_query($qry) or debug_query($qry);
                return $return;
             }

            //=====================================================
            /*
            * Affected Rows function
            *
            * Affected rows Function to get No of rows Affected
            *
            * @access	public
            */
            public function affected_rows() 
           {
                    echo mysql_affected_rows();exit;
           }

           /*
           *Debug Query Function is to debug query and show it error exists
           *
           *@access	public
           *@param                     Query
           *@return                    Mysql Error Output
           */
           function debug_query($query="")
           {

               $output = mysql_query($query) or die('
                        <div style="border:1px solid #D8000C;width:auto;height:auto;background: #FFBABA;">
                        <span style="border:1px solid #D8000C;background-color: #FFBABA;"><h1 style="color: red;">Ooopsss!!! MySQL Error:</h1>
                        <h3>Query:</h3>
                        <span style="color:#D8000C;background: #FFBABA;"><pre>' . htmlentities($query) . '</pre></span>
                        <h3>MySQL Error:</h3>' . mysql_error() . '
                        </span></div>');
               return $output;
           }
           
           function _throwDBException($msg='') 
           {
               
	if($this->dbConn > 0){
		$this->error=mysql_error($this->dbConn);
		$this->errno=mysql_errno($this->dbConn);
	}
	else{
		$this->error=mysql_error();
		$this->errno=mysql_errno();
	
                      echo  '<div style="border:1px solid #D8000C;width:auto;height:auto;">
                        <span style="border:1px solid #D8000C;"><h3 style="color: red;">Database Error</h3>
                        <h3>Message:</h3>
                        <span style="color:#D8000C;background: #FFBABA;"><pre>'.$msg.'</pre></span>
                        <h3>MySQL Error:</h3>'.$this->error.'                       
                        </span></div>';
                  }
	
            }

          public function __destruct() 
         {
              $vars = get_object_vars($this); 
               foreach($vars as $key => $val) {                     
                    //unset($this->$key);
                   $this->$key = NULL;
                  // var_dump($this->$key);
             } 
                unset($this->dbConn);
          }
   }
  //if(!empty($_SERVER['REQUEST_URI'])) echo '<tr><td align="right">Script:</td><td><a href="'.$_SERVER['REQUEST_URI'].'">'.$_SERVER['REQUEST_URI'].'</a></td></tr>'; 
  //if(!empty($_SERVER['HTTP_REFERER'])) echo '<tr><td align="right">Referer:</td><td><a href="'.$_SERVER['HTTP_REFERER'].'">'.$_SERVER['HTTP_REFERER'].'</a></td></tr>'; 

   
   /* End of file DB_model.php */
/* Location: ./phpignite/core/database/DB_model.php */