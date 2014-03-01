<?php
/**
 * A series of prime number functions
 */
class primesGrid{
    var $lastChunk = array();
    var $chunkFileName = 'lastChunk.txt';
    var $createdTables = array();
    var $currentTable = 1;
    public function __construct(){
        global $database,$last,$unitManagment;
        //Retrieves last chunk from file.
        $this->getCurrentTable();
    }
    /**
    * Gets nth prime.
    * 
    * @param int $nth The nth prime you wish to get.
    * @return int The prime number.
    */
    public function getPrime($nth){
        global $database;
        if($nth<100){
            $row=1;
        }else{
            $row=substr($nth,0,strlen($nth)-2);
        }
        $col = substr($nth,-2);
        if($col==00){
            $col = 'n';
        }else{
            abs($col);
        }
        $cols[]='n';
        if($col!='n'){
            for($i=2;$i<=$col;$i++){
                $cols[] = $i;
            }
        }
        $row = $datebase->fetchRow('primeNumbers',$cols,"id=$row");
        for($i=2;$i<=count($row)-1;$i++){
            $row[$i] = $row[$i] << 1;
        }
        if($col=='n'){
            $prime = $row['n'];
        }else{
            $prime = array_sum($row);
        }
        return $prime;
    }
    /**
    * Check to see if a number is a prime.
    * 
    * @param int $n The number you wish to check.
    */
    public function isPrime($n){
        return $this->isPrimeDatabase($n);
    }
    /**
    * Checks database to see if number is prime.
    * 
    * @param mixed $n The number you wish to check.
    */
    private function isPrimeDatabase($n){
        if(!is_numeric($n)){
            die('SQL Injection Attempt?');
        }
        global $database;
        $row = $database->queryFetchRow("
            SELECT
                *
            FROM
                primeNumber
            WHERE
                n<$n
            ORDER BY
                n DESC
            LIMIT
                1
        ");
        $isPrime = false;
        if($row['n'] == $n){
            $isPrime = true;
        }else{
            $total = $row['n'];
            for($i=2;$i<=100;$i++){
                $total += ($row[$i] << 1);
                if($total>$n){
                    break;
                }elseif($total == $n){
                    $isPrime = true;
                    break;
                }
            }
        }
        return $isPrime;
    }
    /**
    * Adds prime numbers to database in compressed format.
    * 
    * @param array $primes Array of prime numbers to be added.
    */
    public function addPrimes($primes){
        global $unitManagment;
        if(count($unitManagment->lastChunk)!=0){
            $primes = array_merge($unitManagment->lastChunk,$primes);
        }
        $primeChunks = array_chunk($primes,100);
        foreach($primeChunks as $chunk){
            if(count($chunk)<100){
                $unitManagment->lastChunk = $chunk;
                return $chunk;
            }else{
                $tables = array();
                global $database;
                $i=1;
                foreach($chunk as $prime){
                    if($i==1){
                        $cols[] = 'n';
                        $data[] = $prime;
                        $lastPrime = $prime;
                    }else{
                        $thisPrime = $prime - $lastPrime;
                        if($thisPrime!=1){
                            $thisPrime = $thisPrime >> 1;
                        }
                        $cols[] = $i;
                        $data[] = $thisPrime;
                        $lastPrime = $prime;
                        $tables[] = $this->getTable($thisPrime);
                    }
                    $i++;
                }
                rsort($tables);
                if($tables[0] > $this->currentTable){
                    $this->currentTable = $tables[0];
                    echo 'New Table Created.<br />';
                }
                if($this->currentTable==1){
                    $table = 'primeNumbers';
                }else{
                    $table = 'primeNumbers'.$this->currentTable;
                }
                $this->insertInToDatabase($table,$cols,$data);
                $unitManagment->lastChunk = array();
            }
            unset($cols,$data,$lastPrime,$tables);
        }
        return true;
    }
    /**
    * Creates table if needed and inserts into 100 chunk into database
    * 
    * @param string $table Name of table to insert to
    * @param array $cols Colums name to insert to
    * @param array $data data to insert into table
    */
    private function insertInToDatabase($table,$cols,$data){
        $table = mysql_real_escape_string($table);
        global $database;
        if(!in_array($table,$this->createdTables) && !$database->tableExists($table)){
            if($table == 'primeNumbers'){
                $intSize = 'TINYINT';
            }elseif($table == 'primeNumbers2'){
                $intSize = 'SMALLINT';
            }elseif($table == 'primeNumbers3'){
                $intSize = 'MEDIUMINT';
            }elseif($table == 'primeNumbers4'){
                $intSize = 'INT';
            }elseif($table == 'primeNumbers5'){
                $intSize = 'BIGINT';
            }
            $query="
                CREATE TABLE `$table` (
                 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                `n` BIGINT UNSIGNED NOT NULL
                ";
                for($i=2;$i<101;$i++){
                    $query.= ",`$i` $intSize UNSIGNED NOT NULL";
                }
                $query.=
                ",
                PRIMARY KEY ( `id` )
                ) ENGINE = MYISAM
            ";
            $database->query($query);
            $this->createdTables[] = $table;
        }elseif(!in_array($table,$this->createdTables)){
            $this->createdTables[] = $table;
        }
        //$database->insert($table,$cols,$data,1,1);
        $colString = '';
        foreach($cols as &$col){
            $colString .= '`'.mysql_real_escape_string($col).'`,';
        }
        $colString = rtrim($colString,',');
        $dataString = '';
        foreach($data as &$value){
            $dataString .= mysql_real_escape_string($value).',';
        }
        $dataString = rtrim($dataString,',');
        mysql_query("INSERT INTO `bigprime_db`.`$table` ($colString) VALUES ($dataString)");
    }
    /**
    * Gets the table name needed for inserting
    * 
    * @param int $dif The difference between two primes
    * @return string The name of the table
    */
    private function getTable($dif){
        $dif = (int)$dif;
        if($dif>18446744073709551615){
            die('Woah the difference between primes is bigger then 18446744073709551615');
        }elseif($dif>4294967295){
            $table = 5;
        }elseif($dif>16777215 && $this->tableNumber>3){
            $table = 4;
        }elseif($dif>65535){
            $table = 3;
        }elseif($dif>255){
            $table = 2;
        }else{
            $table = 1;
        }
        return $table;
    }
    /**
    * Gets the Table it should insert the primes into, depending on size of difference.
    * 
    */
    private function getCurrentTable(){
        global $database;
        if($database->tableExists('primeNumber5')){
            $this->currentTable = 5;
        }elseif($database->tableExists('primeNumber4')){
            $this->currentTable = 4;
        }elseif($database->tableExists('primeNumber3')){
            $this->currentTable = 3;
        }elseif($database->tableExists('primeNumber2')){
            $this->currentTable = 2;
        }elseif($database->tableExists('primeNumber1')){
            $this->currentTable = 1;
        }else{
            $this->currentTable = 1;
        }
    }
    /**
    * Adds/Deletes txt file witch hold an uncomplese chunk
    * 
    * @param array $chunk Uncomplete chunk.
    */
    public function saveUncompleteChunk($chunk){
        global $last;
        if(is_array($chunk)){
            $last->update('chunk',serialize($chunk));
        }else{
            $last->update('chunk','');
        }
    }
}
?>
