<?php

/* =======================================================================*/
/* An open source application development framework for PHP 5.1.6 or newer    
 *                                                                                                                                                 
 * Database Model Class                      
 * A database abstraction layer for the PHP Oracle 8 module                                                                                  
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




$db_error_code  =  0; 
$db_error_msg  =  false; 
$db_error_source  =  false; 

/* 
  *  Database  specific  notes: 
  * 
  *  -  You  must  configure  Oracle  listener  to  use  this  abstraction  layer. 
  * 
  */ 


/** 
  *  @function  db_connect 
  *  @purpose  Connect  to  a  database 
  *  @desc 
  *      Connects  to  a  database  and  returns  and  identifier  for  the  connection. 
  *  @arg  database 
  *      Data  source  name  or  database  host  to  connect  to. 
  *  @arg  user 
  *      Name  of  user  to  connect  as. 
  *  @arg  password 
  *      The  user's  password. 
  */ 
function  db_connect($database,  $user,  $password) 
{ 
        $ret  =  @OCILogon($user,  $password,  $database); 
        db_check_errors($php_errormsg); 
        return  $ret; 
} 

/* 
  *  Function:  db_query 
  *  Arguments:  $conn  (int)          -  connection  identifier 
  *                        $query  (string)  -  SQL  statement  to  execute 
  *  Description:  executes  an  SQL  statement 
  *  Returns:      false  -  query  failed 
  *                    integer  -  query  succeeded,  value  is  result  handle 
  */ 
function  db_query($conn,  $query) 
{ 
        $stmt  =  @OCIParse($conn,  $query); 
        db_check_errors($php_errormsg); 
        if  (!$stmt)  { 
        return  false; 
        } 
        if  (@OCIExecute($stmt))  { 
        return  $stmt; 
        } 
        db_check_errors($php_errormsg); 
        @OCIFreeStatement($stmt); 
        return  false; 
} 

/* 
  *  Function:  db_fetch_row 
  *  Arguments:  $stmt  (int)      -  result  identifier 
  *  Description:  Returns  an  array  containing  data  from  a  fetched  row. 
  *  Returns:      false  -  error 
  *                    (array)  -  returned  row,  first  column  at  index  0 
  */ 
function  db_fetch_row($stmt) 
{ 
        $cols  =  @OCIFetchInto($stmt,  &$row); 
        if  (!$cols)  { 
        db_check_errors($php_errormsg); 
        return  false; 
        } 
        return  $row; 
} 

/* 
  *  Function:  db_free_result 
  *  Arguments:  $stmt  (int)      -  result  identifier 
  *  Description:  Frees  all  memory  associated  with  a  result  identifier. 
  *  Returns:  false  -  failure 
  *                      true  -  success 
  */ 
function  db_free_result($stmt) 
{ 
        global  $db_oci8_pieces; 

        if  (isset($db_oci8_pieces[$stmt]))  { 
        unset($db_oci8_pieces[$stmt]); 
        } 
        $ret  =  @OCIFreeStatement($stmt); 
        db_check_errors($php_errormsg); 
        return  $ret; 
} 

/* 
  *  Function:  db_disconnect 
  *  Arguments:  $connection  (int)  -  connection  identifier 
  *  Description:  closes  a  database  connection 
  *  Returns:  false  -  failure 
  *                      true  -  success 
  */ 
function  db_disconnect($connection) 
{ 
        $ret  =  @OCILogoff($connection); 
        db_check_errors($php_errormsg); 
        return  $ret; 
} 

/* 
  *  Function:  db_autocommit 
  *  Arguments:  $connection  (int)  -  connection  identifier 
  *  Description:  turn  autocommit  on  or  off 
  *  Returns:  false  -  failure 
  *                      true  -  success 
  */ 
function  db_autocommit($connection,  $enabled) 
{ 
        if  (!$enabled)  { 
        db_post_error(0,  "Transactions  not  yet  implemented"); 
        return  false; 
        } 
        return  true; 
} 


function  db_commit($connection) 
{ 
        return  true; 
} 


function  db_rollback($connection) 
{ 
        db_post_error(0,  "Transactions  not  yet  implemented"); 
        return  false; 
} 


function  db_quote_string($string) 
{ 
        $ret  =  ereg_replace( "'",  "''",  $string); 
        return  $ret; 
} 


function  db_prepare($connection,  $query) 
{ 
        global  $db_oci8_pieces; 

        $pieces  =  explode( "?",  $query); 
        $new_query  =  ""; 
        $last_piece  =  sizeof($pieces)  -  1; 
        print  "<br>last_piece=$last_piece\n"; 
        while  (list($i,  $piece)  =  each($pieces))  { 
        $new_query  .=  $piece; 
        if  ($i  <  $last_piece)  { 
                $new_query  .=  ":var$i"; 
        } 
        } 
        print  "<br>new_query=$new_query\n"; 
        $stmt  =  @OCIParse($connection,  $new_query); 
        if  (!$stmt)  { 
        db_check_errors($php_errormsg); 
        return  false; 
        } 
        for  ($i  =  0;  $i  <  $last_piece;  $i++)  { 
        $bindvar  =  ":var$i"; 
        print  "<br>trying  to  bind  $bindvar\n"; 
        if  (!@OCIBindByName($stmt,  $bindvar,  &$db_oci8_pieces[$stmt][$i]))  { 
                db_check_errors($php_errormsg); 
                @OCIFreeStatement($stmt); 
                return  false; 
        } 
        } 
        return  $stmt; 
} 


function  db_execute($stmt,  $data) 
{ 
        global  $db_oci8_pieces; 

        while  (list($i,  $value)  =  each($data))  { 
        $db_oci8_pieces[$stmt][$i]  =  $data[$i]; 
        } 
        $ret  =  @OCIExecute($stmt); 
        if  (!$ret)  { 
        db_check_errors($php_errormsg); 
        return  false; 
        } 
        return  true; 
} 


function  db_error_code() 
{ 
        global  $db_error_code; 
        return  $db_error_code; 
} 


function  db_error_msg() 
{ 
        global  $db_error_msg; 
        return  $db_error_msg; 
} 


function  db_error_source() 
{ 
        global  $db_error_source; 
        return  $db_error_source; 
} 


function  db_check_errors($errormsg) 
{ 
        global  $db_error_code,  $db_error_msg,  $db_error_source; 
        if  (ereg( '^([^:]*):  (...-.....):  (.*)',  $errormsg,  &$data))  { 
        list($foo,  $function,  $db_error_code,  $db_error_msg)  =  $data; 
        $db_error_msg  =  "$function:  $db_error_msg"; 
        $db_error_source  =  "[Oracle][PHP][OCI8]"; 
        }  elseif  (ereg( '^([^:]*):  (.*)',  $errormsg,  &$data))  { 
        list($foo,  $function,  $db_error_msg)  =  $data; 
        $db_error_msg  =  "$function:  $db_error_msg"; 
        $db_error_code  =  0; 
        $db_error_source  =  "[PHP][OCI8][db-oci8]"; 
        }  else  { 
        $db_error_msg  =  $errormsg; 
        $db_error_code  =  0; 
        $db_error_source  =  "[PHP][OCI8][db-oci8]"; 
        } 
} 


function  db_post_error($code,  $message) 
{ 
        global  $db_error_code,  $db_error_msg,  $db_error_source; 
        $db_error_code  =  $code; 
        $db_error_msg  =  $message; 
        $db_error_source  =  "[PHP][OCI8][db-oci8]"; 
} 


function  db_api_version() 
{ 
        return  10;  //  1.0 
} 




/* End of file DB_oracle.php */
/* Location: ./phpignite/core/database/DB_oracle.php */