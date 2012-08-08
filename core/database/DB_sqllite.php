<?php

/* =======================================================================*/
/* An open source application development framework for PHP 5.1.6 or newer    
 *                                                                                                                                                 
 * Mysql driver Class                                                                                                        
 *     This is a PHP5 SQLite abstraction class with many usefull functionnalities
 *      for database creation, triggers, db connections, queries, highlight ...                                                                                                                                            
 * @package		PHP-ignite                                                                      
 * @author		Mr. Sanjoy Dey                                                            
 * @copyright 	Copyright (c)     .........                                                                               
 * @license                                                                                                                              
 * @since		Version 1.0                                                                   
 * @filesource                       
 * @todo                                           Have to check for sql injection, group by, where in, mysql_array, mysql_object, distinct, like, having, aggregate functions, truncate , Join functions, Store Procedures etc.                                                                                              
 */                                                                                                                                              
/* =======================================================================*/



/** 
* SQLite Abstraction class 
* 
* @package 
 sqlite.class.php 
* @access public 
**/ 
class sqlite { 

    var $dbName = ""; //Name of databse 
    var $dbUser = ""; //Database user name 
    var $dbPwd = ""; //Database password 
    var $fallback_keywords = array("ABORT","AFTER","ASC","ATTACH","BEFORE","BEGIN","DEFERRED","CASCADE","CLUSTER","CONFLICT","COPY", 
        "CROSS","DATABASE","DELIMITERS","DESC","DETACH","EACH","END","EXPLAIN","FAIL","FOR","FULL", 
        "IGNORE","IMMEDIATE","INITIALLY","INNER","INSTEAD","KEY","LEFT","MATCH","NATURAL","OF","OFFSET", 
        "OUTER","PRAGMA","RAISE","REPLACE","RESTRICT","RIGHT","ROW","STATEMENT","TEMP","TEMPORARY","TRIGGER", 
        "VACUUM","VIEW"); 
         
    var $normal_keywords = array("ALL","AND","AS","BETWEEN","BY","CASE","CHECK","COLLATE","COMMIT","CONSTRAINT","CREATE", 
        "DEFAULT","DEFERRABLE","DELETE","DISTINCT","DROP","ELSE","EXCEPT","FOREIGN","FROM","GLOB","GROUP", 
        "HAVING","IN","INDEX","INSERT","INTERSECT","INTO","IS","ISNULL","JOIN","LIKE","LIMIT", 
        "NOT","NOTNULL","NULL","ON","OR","ORDER","PRIMARY","REFERENCES","ROLLBACK","SELECT","SET", 
        "TABLE","THEN","TRANSACTION","UNION","UNIQUE","UPDATE","USING","VALUES","WHEN","WHERE"); 
     
    /** 
     * Constructor 
     * @access protected 
     */ 
    function sqlite(){ 
    } 
     
    /** 
     * sqlite::version() 
     * 
     * @return 
     **/ 
    function version(){ 
        return "1.1"; 
    } 
     
    /** 
     * sqlite::dbconnect() 
     * 
     * @param string $dbUser 
     * @param string $dbPwd 
     * @param string $dbName 
     * @return 
     **/ 
    function dbconnect($dbUser="", $dbPwd="",$dbName=':memory:'){ 
        if ($dbUser!="") { 
            $this->dbUser = $dbUser; 
        } 
        if ($dbPwd!="") { 
            $this->dbPwd = $dbPwd; 
        } 
        if ($dbName!="") { 
            $this->dbName = $dbName; 
        } 
        $this->Link_ID = sqlite_open($this->dbName,0666) or die (_CONNECTION_ERROR_.sqlite_error_string()." <br><br>"); 
    } 
     
    /** 
     * sqlite::query() 
     * 
     * @param $query 
     * @return 
     **/ 
    function query($query){ 
        $this->dbQryResult = sqlite_query($query,$this->Link_ID); 
        return $this->dbQryResult; 
    } 
     
    /** 
     * sqlite::fetch_row() 
     * 
     * @param string $result 
     * @return 
     **/ 
    function fetch_row($result = "") 
    { 
        $this->dbResultLine = sqlite_fetch_single($result); 
        return $this->dbResultLine; 
    } 

    /** 
     * sqlite::get_data() 
     * 
     * @param string $result 
     * @return 
     **/ 
    function get_data($result = "") 
    { 
        return $this->fetch_row($this->dbQryResult); 
    } 
     
    /** 
     * sqlite::fetch_array() 
     * 
     * @param string $result 
     * @return 
     **/ 
    function fetch_array($result = "") 
    { 
        $this->dbResultLine = @sqlite_fetch_array($result); 
        return $this->dbResultLine; 
    } 
     
    /** 
     * sqlite::get_db_tables() 
     * 
     * @return 
     **/ 
    function get_db_tables(){ 
     $result = $this->query("select name,upper(name) from SQLITE_MASTER where type = 'table' order by 2"); 
         
        if (!$result) { 
            print "Erreur : impossible de lister les tables\n"; 
            exit; 
        } 
         
        while ($row = $this->fetch_row($result)) { 
            $Tables[] = $row; 
        } 
        return $Tables;         
    } 
     
    /** 
     * sqlite::get_db_triggers() 
     * 
     * @return 
     **/ 
    function get_db_triggers(){ 
     $result = $this->query("select name,upper(name),sql from SQLITE_MASTER where type = 'trigger' order by 2"); 
         
        if (!$result) { 
            print "Erreur : impossible de lister les tables\n"; 
            exit; 
        } 
         
        while ($row = $this->fetch_row($result)) { 
            $Trigger[] = $row; 
        } 
        return $Trigger;         
    } 
     
    /** 
     * sqlite::get_trigger_infos() 
     * 
     * @param $triggername 
     * @return 
     **/ 
    function get_trigger_infos($triggername){ 
     $result = $this->query("SELECT * FROM SQLITE_MASTER where type = 'trigger' and name = '".$triggername."'"); 

        $ray = $this->fetch_array($result); 

        return $ray[sql]; 
    } 
     
    /** 
     * sqlite::get_table_infos() 
     * 
     * @param $tablename 
     * @return 
     **/ 
    function get_table_infos($tablename){ 
     $result = $this->query("SELECT type, name, tbl_name, rootpage, sql FROM SQLITE_MASTER where tbl_name = '" . $tablename . "'"); 

        $ray = $this->fetch_array($result); 
        return $ray[sql]; 
    } 
     
    /** 
     * sqlite::get_dbs() 
     * 
     * @param string $path 
     * @return 
     **/ 
    function get_dbs($path = "db/"){ 
     
        $d = opendir($path); 
        while(($entry = readdir($d)) != false) { 
            if ($entry!="." and $entry!=".." and ereg(".db$",$entry)) { 
                $DBS[] = $entry; 
            } 
        } 
        return $DBS;     
    } 

    /** 
     * sqlite::createdb() 
     * 
     * @param $dbname 
     * @param string $path 
     * @return 
     **/ 
    function createdb($dbname , $path = "db/"){ 
        if (trim($dbname)=="" or is_file($path.$dbname)) { 
            return FALSE; 
        } 
        touch($path.$dbname); 
        chmod($path.$dbname,0666 ); 
        return true; 
    } 

    /** 
     * sqlite::dropdb() 
     * 
     * @param $dbname 
     * @param string $path 
     * @return 
     **/ 
    function dropdb($dbname , $path = "db/"){ 
        if (!$this->is_db($dbname )) { 
            return FALSE; 
        } 

        if(unlink($path.$dbname)) return true; 
         
        return false; 
    } 
     
    /** 
     * sqlite::isdb() 
     * 
     * @param $dbname 
     * @param string $path 
     * @return 
     **/ 
    function is_db($dbname , $path = "db/"){ 
        if (trim($dbname)=="" or trim($dbname)==".db" or !is_file($path.$dbname)) { 
            return FALSE; 
        } 
        return true; 
    } 
     
    /** 
     * sqlite::get_db_size() 
     * 
     * @param $dbname 
     * @param string $path 
     * @return 
     **/ 
    function get_db_size($dbname , $path = "db/"){ 
        if (trim($dbname)=="" or !is_file($path.$dbname)) { 
            return FALSE; 
        } 
        return round(filesize($path.$dbname)/1024); 
    } 
     
    /** 
     * 
     * @access public 
     * @return void 
     **/ 
    function highlite($query){ 
        $result = array_merge ($this->normal_keywords, $this->fallback_keywords); 
        foreach($result as $v){ 
            if ($v!="OR" and $v!="IS" and $v!="IN") { 
                $search[] = "/(?i)(^|[^a-z0-9\_]){1}(".strtoupper($v).")([^a-z0-9\_]|$){1}/"; 
                $replace[] = "\\1<span style=\"color: blue; background-color: white; font-weight: bold;\">\\2</span>\\3"; 
            } 
        } 
        $parsed_query = preg_replace($search,$replace , $query); 
        return $parsed_query; 
    } 
     
} 


/* End of file DB_sqllite.php */
/* Location: ./phpignite/core/database/DB_sqllite.php */