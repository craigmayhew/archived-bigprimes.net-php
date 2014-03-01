<?php
/**
 * The database class is used to connect to any database, currently this class only contains functions to connect to mysql.
 */
class database{
    /**
    * $databaseType: Defaults to 'mysql' and is used to call correct functions.
    * @var string
    */
    var $databaseType='mysql';
    /**
    * $lastQuery: Contains the previous querystring.
    * @var string
    */
    var $lastQuery='';
    /**
    * $lastQuery: Contains the number of rows returned by the previous query.
    * @var string
    */
    var $lastnumberOfRows='';
    /**
    * $lastId: The id of the last auto incremented insert, is the same as calling mysql_inset_id().
    * @var string
    */
    var $lastId = 0;
    /**
    * $logTable: The name of the database table to store the mysql logs.
    * @var string
    */
    var $logTable = 'databaseLog';
    /**
    * $lastError: The last database error that occured.
    * @var string
    */
    var $lastError = '';
    /**
    * Connect to the database, create a database log table if one doesn't exist.
    */
    var $logQuerys = false;
    var $connected = false;
    private $config;
    /**
    * Connect to the database, create a database log table if one doesn't exist.
    */
    function __construct($classes,$host,$username,$password,$db,$databaseType='mysql',$create=true){
		$this->config = $classes['config'];    
		$this->databaseType = $databaseType;
        $connect =  $this->databaseType.'Connect';
        $this->$connect($host,$username,$password,$db,$create);
        if($this->connected){
            $hasLogTable = $this->tableExists($this->logTable);
            if(!$hasLogTable){
                $this->addLogTable();
            }
        }
    }
    /**
    * Return a multi dimensional array of rows from the database, specifying parts of the query.
    *
    * @param string $sTable The table name
    * @param array $aColumns Array of columns to be returned
    * @param string $where e.g. "column='value'"
    * @param string $sLimit in the format 5 or "0,5"
    * @param string $sOrder a list of comma seperated columns
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return multidimentional array of results in the format $row[]['columnName']=>'columnValue';
    */
    function fetchRows($sTable,$aColumns,$where='',$sLimit='',$sOrder='',$bAssoc=true,$bDebug=false){
        $fetchRows =  $this->databaseType.'FetchRows';
        return $this->$fetchRows($sTable,$aColumns,$where,$sLimit,$sOrder,$bAssoc,$bDebug);
    }
    /**
    * Return a row from the database, specifying parts of the query.
    *
    * @param string $sTable The table name
    * @param array $aColumns Array of columns to be returned
    * @param string $where e.g. "column='value'"
    * @param string $sOrder a list of comma seperated columns
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return array of row columns in the format $row['columnName']=>'columnValue'';
    */
    function fetchRow($sTable,$aColumns,$where='',$sOrder='',$bAssoc=true,$bDebug=false){
        $fetchRow =  $this->databaseType.'FetchRow';
        return $this->$fetchRow($sTable,$aColumns,$where,$sOrder,$bAssoc,$bDebug);
    }
    /**
    * Return a row from the database, specifying the enitre query string.
    *
    * @param string $sQuery The entire querystring, please make sure it's been sanitized.
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return multidimentional array of results in the format $row[]['columnName']=>'columnValue';
    */
    function queryFetchRows($sQuery,$bAssoc=true,$bDebug=false){
        $queryFetchRows =  $this->databaseType.'QueryFetchRows';
        return $this->$queryFetchRows($sQuery,$bAssoc,$bDebug);
    }
    /**
    * Return a row from the database, specifying the enitre query string.
    *
    * @param string $sQuery The entire querystring, please make sure it's been sanitized.
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return array of row columns in the format $row['columnName']=>'columnValue'';
    */
    function queryFetchRow($sQuery,$bAssoc=true,$bDebug=false){
        $queryFetchRow =  $this->databaseType.'QueryFetchRow';
        return $this->$queryFetchRow($sQuery,$bAssoc,$bDebug);
    }
    /**
    * Update a database row, specifying parts of the query.
    *
    * @param array $aData The array of columns and their new values
    * @param string $table The database table name
    * @param string $where e.g. "column='value'"
    * @param bool $showQuery Flag to set the returned array to be associative or not. Defaults to true.
    * @return array of row columns in the format $row['columnName']=>'columnValue'';
    */
    function update($aData,$table,$where,$debug=false){
        $update =  $this->databaseType.'Update';
        return $this->$update($aData,$table,$where,$debug);
    }
    /**
    * Update a database row, specifying the entire query.
    *
    * @param string $query The entire querystring, please make sure it's been sanitized.
    * @param bool $debug Flag for debug output. Defaults to false.
    * @return array of row columns in the format $row['columnName']=>'columnValue'';
    */
    function queryUpdate($query,$debug=false){
        $queryUpdate =  $this->databaseType.'QueryUpdate';
        return $this->$queryUpdate($query,$debug);
    }
    /**
    * Inserts new row into database
    *
    * @param string $table The database table name
    * @param array $aColumns Array of columns to be populated
    * @param array $aInsert Array of values to be inserted
    * @param bool $debug Flag for debug output. Defaults to false.
    * @return bool
    */
    function insert($table,$aColumns,$aInsert,$debug=false){
        $insert =  $this->databaseType.'Insert';
        return $this->$insert($table,$aColumns,$aInsert,$debug);
    }
    /**
    * Deletes rows from table
    *
    * @param string $table The database table name
    * @param string $where e.g. "column='value'"
    * @param bool $debug Flag for debug output. Defaults to false.
    * @return bool
    */
    function deleteRows($table,$where,$debug=false){
        $deleteRows =  $this->databaseType.'DeleteRows';
        return $this->$deleteRows($table,$where,$debug);
    }
    /**
    * Return a row count for the given query parameters
    *
    * @param string $table The database table name
    * @param string $where e.g. "column='value'"
    * @param bool $debug Flag for debug output. Defaults to false.
    * @return bool
    */
    function count($table,$where='',$debug=false){
        $count =  $this->databaseType.'Count';
        return $this->$count($table,$where,$debug);
    }
    /**
    * Check to see if a database table exists.
    *
    * @param string $table The database table name
    * @return bool
    */
    function tableExists($tableName){
        $tableExists = $this->databaseType.'TableExists';
        return $this->$tableExists($tableName);
    }
    /**
    * Add a log entry to the database logs table
    *
    * @param string $sql The querystring that you want added to the log
    * @param $action The databse action, e.g. Insert, Update, Delete
    * @return bool Returns true on success and false on failure
    */
    function addLog($sql,$action){
        if($this->logQuerys){
            $addLog = $this->databaseType.'AddLog';
            $this>$addLog($sql,$action,$success);
        }
    }
    /**
    * Adds the log table to database
    *
    * @return bool Returns true on success and false on failure
    */
    function addLogTable(){
        $addLogTable = $this->databaseType.'AddLogTable';
        $this->$addLogTable();
    }
    /**
    * Creates a new table
    * @param string $sql The entire querystring, please make sure it's been sanitized.
    * @param bool $debug Flag for debug output. Defaults to false.
    * @return bool Returns true on success and false on failure
    */
    function createTable($sql,$debug=false){
        $createTable = $this->databaseType.'CreateTable';
        $this->$createTable($sql,$debug);       
    }
    /**
    * Returns a tables column names
    * @param string $table The name of the table
    * @return bool Returns an array of column names
    */
    function tableColumns($table){
        $tableColumns = $this->databaseType.'TableColumns';
        return $this->$tableColumns($table);       
    }
    /**
    * Rename a table
    * @param string $oldName The current table name
    * @param string $newName The new table name
    * @return bool Returns true on success and false on failure
    */
    function renameTable($oldName,$newName){
        $renameTable = $this->databaseType.'RenameTable';
        return $this->$renameTable($oldName,$newName);
    }
    /**
    * Run a query
    * @param string $query The entire querystring, please make sure it's been sanitized.
    * @return bool Returns true on success and false on failure
    */
    function query($query){
        $queryFunc = $this->databaseType.'Query';
        return $this->$queryFunc($query);
    }
    function changeDatabase($dbName){
        if(!mysql_select_db($dbname)){
            trigger_error('Cant select database "'.$dbName.'". Mysql Error:'.mysql_error());
        }
    }

    /************************************
    * Mysql Methods
    ************************************/
    /**
    * Connect to mysql database
    * @param string $host
    * @param string $username Mysql username
    * @param string $password Mysql password
    * @param string $db Mysql database
    * @param bool $create If the database doesn't exist should it be created?
    * @return bool Returns true on success and triggers an error on failure
    */
    private function mysqlConnect($host,$username,$password,$db,$create=false){
        //Conects to database server
        if(!@mysql_connect($host,$username,$password)){
            //trigger_error('Unable to connect to the server: '.$server, E_USER_WARNING);
        }else{
            //Select databse
            if(!@mysql_select_db($db)){
                //If the user has set it to create a new databse if there is all ready not one, it will attamp to to create one.
                if($create==true){
                    //Create dataabse.
                    $query = 'CREATE DATABASE '.$db;
                    if(@mysql_query($query)){
                        //Select database
                        if(!@mysql_select_db($db)){
                            //trigger_error('Unable to connect to the database:'.$db, E_USER_WARNING);
                        }else{
                            $this->connected = true;
                        }
                    }else{
                        //trigger_error('Unable to create database:'.$db, E_USER_WARNING);
                    }
                }else{
                    //trigger_error('Unable to connect to the database:'.$db, E_USER_WARNING);
                }
            }else{
                $this->connected = true;
            }
        }
    }
    /**
    * Return a multi dimensional array of rows from the MySQL database, specifying parts of the query.
    *
    * @param string $sTable The table name
    * @param array $aColumns Array of columns to be returned
    * @param string $where e.g. "column='value'"
    * @param string $sLimit in the format 5 or "0,5"
    * @param string $sOrder a list of comma seperated columns
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return multidimentional array of results in the format $row[]['columnName']=>'columnValue';
    */
    private function mysqlFetchRows($sTable,$aColumns,$where='',$sLimit='',$sOrder='',$bAssoc=true,$bDebug=false){
        //checks to see if we want a associative array.
        if($bAssoc == true){
            $assoc = MYSQL_ASSOC;
        }else{
            $assoc = MYSQL_NUM;
        }
        //builds query
        $query = 'SELECT ';
        if(is_array($aColumns) == true){
            $first = true;
            foreach($aColumns as $column){
                if(stristr($column,' ')==true || stristr($column,'DISTINCT')==true || stristr($column,'DATE_FORMAT')==true){
                    $query .= "$column,";
                }else{
                    $column = mysql_real_escape_string($column);
                    $query .= "`$column`,";
                }
            }
            $query = rtrim($query,',');
        }else{
            $query .= '*';
        }
        $query .= ' FROM `'.mysql_real_escape_string($sTable).'`';
        if($where != ''){
            $query .= " WHERE $where";
        }
        if($sOrder != ''){
            $query .= ' ORDER BY '.mysql_real_escape_string($sOrder);
        }
        if($sLimit != ''){
            $query .= ' LIMIT '.mysql_real_escape_string($sLimit);
        }
        
        //Does query
        $result = $this->mysqlQuery($query);
        $this->lastnumberOfRows = mysql_num_rows($result);
        if($this->lastnumberOfRows==0){
            $array = array();
        }else{
            //pus data into array
            while($row = mysql_fetch_array($result,$assoc)){
                $array[] = $row;
            }
        }
        if($bDebug == true){
            echo '<b>Query:</b>',$query,'<br /><b>Error:</b>',$this->lastError,'<b>Number of Rows:</b>'.$this->lastNumberOfRows;
        }
                
        //returns array of results        
        return $array;
    }
    /**
    * Return a row from the MySQL database, specifying parts of the query.
    *
    * @param string $sTable The table name
    * @param array $aColumns Array of columns to be returned
    * @param string $where e.g. "column='value'"
    * @param string $sOrder a list of comma seperated columns
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return array of row columns in the format $row['columnName']=>'columnValue'';
    */
    private function mysqlFetchRow($sTable,$aColumns,$where='',$sOrder='',$bAssoc=true,$bDebug=false){
        //checks to see if we want a associative array.
        if($bAssoc == true){
            $assoc = MYSQL_ASSOC;
        }else{
            $assoc = MYSQL_NUM;
        }
        //builds query
        $query = 'SELECT ';
        if(is_array($aColumns) == true){
            $first = true;
            foreach($aColumns as $column){
                if(stristr($column,' ')==true || stristr($column,'DISTINCT')==true || stristr($column,'DATE_FORMAT')==true){
                    $query .= "$column,";
                }else{
                    $column = mysql_real_escape_string($column);
                    $query .="`$column`,";
                }
            }
            $query = rtrim($query,',');
        }else{
            $query .= '*';
        }
        $query .= ' FROM `'.mysql_real_escape_string($sTable)."`";
        if($where != ''){
            $query .= " WHERE $where";
        }
        if($sOrder!=''){
            $query.=' ORDER BY '.mysql_real_escape_string($sOrder);
        }
        //tell mysql to stop once it's found one row
        $query .= ' LIMIT 1';
        
        //Does query
        $result = $this->mysqlQuery($query);
        $this->lastnumberOfRows = mysql_num_rows($result);
        //Puts data into array
        if(is_string($aColumns) == true || count($aColumns) > 1){
            //Sorts query into array
            $array = mysql_fetch_array($result,$assoc);
        //If there is only one column does not put it in array.
        }else{
            $array = @mysql_result($result,0);
        }
        if($bDebug == true){
            echo '<b>Query:</b>',$query,'<br /><b>Error:</b>',$this->lastError.'<br />';
        }
        
        //returns array of results        
        return $array;
    }
    /**
    * Return rows from the MySQL database, specifying the enitre query string.
    *
    * @param string $sQuery The entire querystring, please make sure it's been sanitized.
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return multidimentional array of results in the format $row[]['columnName']=>'columnValue';
    */
    private function mysqlQueryFetchRows($sQuery,$bAssoc=true,$bDebug=false){
        $array = array();
        //checks to see if we want a associative array.
        if($bAssoc == true){
            $assoc = MYSQL_ASSOC;
        }else{
            $assoc = MYSQL_NUM;
        }
        //Does query
        $result = $this->mysqlQuery($sQuery);
        $numRows = mysql_num_rows($result);
        $this->lastnumberOfRows = mysql_num_rows($result);
        //If there is more than one row puts data into multidimtional array.
        if($numRows > 0){
            //Sorts query into array
            $c = 0;
            $array = array();
            while($row = mysql_fetch_array($result,$assoc)){
                $array[$c] = $row;
                $c++;
            }
        //If there is only one row puts into array.
        }else{
            $array = array();
        }
        if($bDebug == true){
            echo '<b>Query:</b><pre>',$sQuery,'</pre><br /><b>Error:</b>',$this->lastError,'<br>';
        }
        
        //returns array of results        
        return $array;
        
    }    
    /**
    * Return a row from the MySQL database, specifying parts of the query.
    *
    * @param string $sTable The table name
    * @param array $aColumns Array of columns to be returned
    * @param string $where e.g. "column='value'"
    * @param string $sOrder a list of comma seperated columns
    * @param bool $bAssoc Flag to set the returned array to be associative or not. Defaults to true.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return array of row columns in the format $row['columnName']=>'columnValue'';
    */
    private function mysqlQueryFetchRow($sQuery,$bAssoc=true,$bDebug=false){
        $array = array();
        //checks to see if we want a associative array.
        if($bAssoc == true){
            $assoc = MYSQL_ASSOC;
        }else{
            $assoc = MYSQL_NUM;
        }
        //Does query
        $result = $this->mysqlQuery($sQuery);
        $numRows = mysql_num_rows($result);
        $this->lastnumberOfRows = mysql_num_rows($result);
        //If there is more than one row puts data into multidimtional array.
        if($numRows > 0){
            $array = mysql_fetch_array($result,$assoc);
        //If there is only one row puts into array.
        }else{
            $array = array();
        }
        if($bDebug == true){
            echo '<b>Query:</b><pre>',$sQuery,'</pre><br /><b>Error:</b>',$this->lastError,'<br>';
        }
        
        //returns array of results        
        return $array;
        
    }    
    /**
    * Update a MySQL database row, specifying parts of the query.
    *
    * @param array $aData The array of columns and their new values
    * @param string $table The database table name
    * @param string $where e.g. "column='value'"
    * @param bool $showQuery Flag to set the returned array to be associative or not. Defaults to true.
    * @return array of row columns in the format $row['columnName']=>'columnValue'';
    */
    private function mysqlUpdate($aData,$table,$where,$showQuery=false){
        //gets colunm names from the key
        $aColumns = array_keys($aData);
        $c = count($aData);
        //Build query string
        $query = 'UPDATE `'.$table.'` SET ';
        $first = true;
        for($i=0;$i<$c;$i++){
            $aColumns[$i] = mysql_real_escape_string($aColumns[$i]);
            $aData[$aColumns[$i]] = mysql_real_escape_string($aData[$aColumns[$i]]);
            $s='';
            if(is_numeric($aData[$aColumns[$i]])==false && $aData[$aColumns[$i]]!='CURRENT_TIMESTAMP')$s="'";
            if($first == true){
                $query .= '`'.$aColumns[$i].'`='.$s.$aData[$aColumns[$i]].$s;
                $first = false;
            }else{
                $query .= ', `'.$aColumns[$i].'`='.$s.$aData[$aColumns[$i]].$s;
            }
        }
        $query .= ' WHERE '.$where;
        $result = $this->mysqlQuery($query,'Update');
        if($showQuery == true){
            echo '<b>Query:</b>',$query,'<br><b>Error:</b>',$this->lastError;
        }
        return $result;
    }
    /**
    * Update a database, specifying the entire query.
    *
    * @param string $query The entire querystring, please make sure it's been sanitized.
    * @param bool $debug Flag for debug output. Defaults to false.
    * @return bool Returns true on success
    */
    private function mysqlQueryUpdate($query,$debug=false){
        $outcome = $this->mysqlQuery($query,'Update');
        if($debug){
            echo '<b>Query:</b>',$query,'<br /><b>Error:</b>',$this->lastError,'<br />';
        }
        return $outcome;
    }
    /**
    * Inserts new row into MySQL database
    *
    * @param string $table The database table name
    * @param array $aColumns Array of columns to be populated
    * @param array $aInsert Array of values to be inserted
    * @param bool $debug Flag for debug output. Defaults to false.
    * @return bool
    */
    private function mysqlInsert($table,$aColumns,$aInsert,$debug = false){
        $reservedWords = array('CURRENT_TIMESTAMP');
        $query = 'INSERT INTO `'.$table.'` (';
        $c = count($aColumns);
        //column names
        for($i=0;$i<$c;$i++){
            $aColumns[$i]=mysql_real_escape_string($aColumns[$i]);
            if($i == ($c-1)){
                $query .= '`'.$aColumns[$i].'`) VALUES ';
            }else{
                $query .= '`'.$aColumns[$i].'`, ';
            }
        }
        //column values
        $is_array = is_array($aInsert[0]);
        //If is_array is true then we are inputing more than one row.
        if($is_array){
            $c = count($aInsert);
            for($i=0;$i<$c;$i++){
                $query .= '(';
                $c2 = count($aInsert[$i]);
                for($i2=0;$i2<$c2;$i2++){
                    $array_insert[$i][$i2] = mysql_real_escape_string($aInsert[$i][$i2]);
                    if (in_array($aInsert[$i][$i2],$reservedWords,1)){
                        $query .= $aInsert[$i][$i2];
                    }elseif(is_int($aInsert[$i][$i2])){
                        $query .= $aInsert[$i][$i2];
                    }else{
                        $query .= "'".$aInsert[$i][$i2]."'";
                    }
                    
                    if($i2 != ($c2-1)){
                        $query .= ', ';
                    }
                }
                if($i == ($c-1)){
                    $query .= ')';
                }else{
                    $query .= '),';
                }
            }
        }else{
            $c = count($aInsert);
            $query .= '(';
            for($i=0;$i<$c;$i++){
                $array_insert[$i] = mysql_real_escape_string($aInsert[$i]);
                if (in_array($aInsert[$i],$reservedWords,1)){
                    $query .= $aInsert[$i];
                }elseif(is_int($aInsert[$i])){
                    $query .= $aInsert[$i];
                }else{
                    $query .= "'".$aInsert[$i]."'";
                }
                
                if($i != ($c-1)){
                    $query .= ', ';
                }
            }
            $query .= ')';
        }
        $result = $this->mysqlQuery($query,'Insert');
        if($debug == true){
            echo '<b>Query:</b>',$query,'<br><b>Error:</b>',$this->lastError;
        }
        
        return $result;
        
    }
    /**
    * Deletes rows from MySQL table
    *
    * @param string $table The database table name
    * @param string $where e.g. "column='value'"
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return bool
    */
    private function mysqlDeleteRows($table,$where,$bDebug=false){
        $query = 'DELETE FROM '.mysql_real_escape_string($table).' WHERE '.$where;
        $this->mysqlQuery($query,'Delete');
        if($bDebug == true){
            echo '<b>Query:</b>'.$query.'<br /><b>Error:</b>',$this->lastError,'<br />';
        }
        
    }
    /**
    * Return a MySQL row count for the given query parameters
    *
    * @param string $table The database table name
    * @param string $where e.g. "column='value'"
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return bool
    */
    private function mysqlCount($table,$where='',$bDebug=false){
        $query = 'SELECT COUNT(*) FROM `'.mysql_real_escape_string($table).'`'.($where!=''?' WHERE '.$where:'');
        $result = $this->mysqlQuery($query);
        $result = mysql_result($result,0);
        if($bDebug == true){
            echo 'Query:',$query,'<br />Error:',$this->lastError,'<br />Result:',$result,'<br />';
        }
        return $result;
    }
    /**
    * Check to see if a MySQL database table exists.
    *
    * @param string $tableName The database table name
    * @return bool
    */
    private function mysqlTableExists($tableName){
        $return = false;
        $result = mysql_list_tables($this->config['db']['db']);
        $num_rows = mysql_num_rows($result);
        for ($i = 0; $i < $num_rows; $i++) {
            $table = mysql_tablename($result, $i);
            if($table == $tableName){
                $return=true;
                break;
            }
        }        
        return $return;
    }
    /**
    * Run a MySQL query
    * @param string $sql The entire querystring, please make sure it's been sanitized.
    * @param string $action Used for logging, e.g. UPDATE, INSERT, DELETE
    * @return bool Returns true on success and false on failure
    */
    private function mysqlQuery($sql='',$action=''){
        $out = mysql_query($sql);
        $this->lastId = mysql_insert_id();
        $mysql_error = mysql_error();
        if($mysql_error){
           trigger_error('Mysql Error No:'.mysql_errno().' Mysql Error:'.$mysql_error, E_USER_WARNING); 
        }
        $this->lastError = $mysql_error;
        $this->lastQuery=$sql;
        if ($action != ''){
            $success = ($out==false)?0:1;
            $this->addLog($sql,$action,$success);
        }
        return $out;
    }
    /**
    * Creates a new MySQL table
    * @param string $sql The entire querystring, please make sure it's been sanitized.
    * @param bool $bDebug Flag for debug output. Defaults to false.
    * @return bool Returns true on success and false on failure
    */
    private function mysqlCreateTable($sql,$bDebug=false){
        $this->mysqlQuery($sql,'Create Table');
        if($bDebug == true){
            echo 'Query:',$sql,'<br />Error:',mysql_error(),'<br />Result:',$result,'<br />';
        }
        return $result;
    }
    /**
    * Add a log entry to the MySQL database logs table
    *
    * @param string $sql The querystring that you want added to the log
    * @param $action The databse action, e.g. Insert, Update, Delete
    * @param $success Flag, if the query failed
    * @return bool Returns true on success and false on failure
    */
    private function mysqlAddLog($sql,$action,$success=''){
        $sqlSHA = sha1($sql);
        //lookup
        $c = $this->mysqlCount('databaseLogSql','sha="'.$sqlSHA.'"');
        if ($c == 0){//add the sql to the sql lookup table if its not already in there
            mysql_query("INSERT INTO databaseLogSql (sql,sha) VALUES ('".addslashes($sql)."','".mysql_real_escape_string($sqlSHA)."')");
            $sqlId = mysql_insert_id();
        }else{
            $sqlId = $this->mysqlFetchRow('databaseLogSql',array('id'),'sha="'.$sqlSHA.'"');
        }
        
        $out = mysql_query("INSERT INTO databaseLog (action,sql) VALUES ('".mysql_real_escape_string($action)."',".(int)($sqlId).')');
        //echo "INSERT INTO databaseLog (action,sql) VALUES ('".mysql_real_escape_string($action)."','".addslashes($sqlId)."')";
        return $out;
    }
    /**
    * Adds the log table to the mysql database
    *
    * @return bool Returns true on success and false on failure
    */
    private function mysqlAddLogTable(){
        $tableExists = $this->tableExists($this->logTable);
        if ($tableExists == false){
            $sql = 
                'CREATE TABLE `databaseLog` (
                `id` int(10) unsigned NOT NULL default \'0\',
                `action` varchar(31) NOT NULL default \'\',
                `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
                `sql` longtext NOT NULL,
                PRIMARY KEY  (`id`),
                KEY `action` (`action`,`timestamp`)
                ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT=\'All database queries should be logged within this table\'';
            $this->createTable($sql);
        }
    }
    /**
    * Returns a MySQL tables column names
    * @param string $table The name of the table
    * @return bool Returns an array of column names
    */
    private function mysqlTableColumns($table){
        $query = "SHOW COLUMNS FROM `$table`";
        $result = $this->mysqlQuery($query);
        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
            $array[] = $row;
        }
        return $array;
    }
    /**
    * Rename a MySQL table
    * @param string $oldName The current table name
    * @param string $newName The new table name
    * @return bool Returns true on success and false on failure
    */
    private function mysqlRenameTable($oldName,$newName){
        $query = "RENAME TABLE `$oldName` TO `$newName`";
        return $this->mysqlQuery($query);
    }
}
?>
