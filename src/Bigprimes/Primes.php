<?php
namespace Bigprimes;

class Primes{
    private $app;
    private $primes;
    private $numbersPerRow = 100;
    private $maxPrime = 1400000000;
    public function __construct($app){
        $this->app = $app;
    }

    /**
    * Gets nth prime.
    * 
    * @param int $nth The nth prime you wish to get.
    * @return int The prime number.
    */
    public function getPrime($nth){
        $prime = false;
        if($nth > $this->maxPrime){
            return false;
        }
            //Works out what row to pull from the database.
            $rowNo = ceil($nth/$this->numbersPerRow);
            //Calculats column that is needed.
            $col = $nth%$this->numbersPerRow;
            if($col==1){
                $col='n';
            }elseif($col==0){
                $col=$this->numbersPerRow;
            }
            //Creates colunm array for database query.
            $cols[]='n';
            if($col!='n'){
                $cols += range(2, $col);
            }
            //Fetch row
            $sql = 'SELECT `'.implode('`,`',$cols).'` FROM primeNumbers WHERE id = ?';
            $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array($rowNo));

            if(!is_array($row)){
                return false;
            }

            if(is_array($row)){
                //Times each delta col by two.
                $i = ($rowNo==1) ? 3 : 2;
                while($i<=count($row)){
                    $row[$i] = $row[$i] << 1;
                    $i++;
                }
            }
            //Calulate prime.
            $prime = array_sum($row);
        
         return $prime;
    }
    /**
    * Checks to see if a given number is a prime.
    * 
    * @param mixed $num The number you wish to check for primality.
    * @return boolean Flase if given number is not a prime. What number prime it is if is a prime.
    */
    public function checkPrime($num){
        $num = (int)$num;
        if($num === 1){
            return false;
        }
        
        //Fetch first row that n is bigger than or equal to given number.
        $sql = 'SELECT id FROM primeNumbers WHERE n > ? LIMIT 1';
        $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array((int)$num));
        $id = $row['id'];
        $id--;
    
        $sql = 'SELECT * FROM primeNumbers WHERE id = ? LIMIT 1';    
        if(!is_int($id)){
            //$id = $this->database->count('primeNumbers');
            return false;
        }
        $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array((int)$id));
        //Checks to see if prime is within the verified primes.
        if($row == false){
            return null;
        }elseif(($row['id']*100) <= $this->maxPrime && $id){
            //Loop through each number of the row untill given number is found.
            $n = 0;
            $haveNumber = false;
            foreach($row as $k=>$col){
                if($row['id']==1 && $k=='2'){
                    //Do nothing.
                }else{
                    if($k!='n'){
                        //Times by two.
                        $col = $col << 1;
                    }
                }
                if($k!='id'){
                    //Add current col to $n.
                    $n+=$col;
                    //If n is equal to given number
                    if($n==$num){
                        //Save the columns and break from loop.
                        $haveNumber = true;
                        $whatCol = $k;
                        break;
                    }
                }
            }
            //Check to see if we have found the number.
            if($haveNumber){
                //If they we have then calulate what number prime it is.
                if($whatCol=='n'){
                    $numPrime = (($row['id']-1)*$this->numbersPerRow)+1;
                }else{
                    $numPrime = (($row['id']-1)*$this->numbersPerRow)+$whatCol;
                }
                return $numPrime;
            }else{
                //If we havnt then return false.
                return false;
            }
        }
        return null;
    }
    /**
    * Return a 100 set of primes.
    * 
    * @param mixed $id The id of the row to pull.
    */
    public function primeSet($id){
        $id = (int)$id;
        $sql = 'SELECT * FROM primeNumbers WHERE id = ? LIMIT 1';
        $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array($id));
        
        if (!is_array($row)) {
          return [];
        }
        //Loop through each number and add them together.
        $n = 0;
        $haveNumber = false;
        $last = 0;
        $numbers = [];
        foreach($row as $k=>$col){
            if($k!='id'){
                if($row['id']==1 && $k=='2'){
                    //Do nothing.
                }else{
                    if($k!='n'){
                        //Times by two.
                        $col = $col << 1;
                    }
                }
                $thisNumber = $col+$last;
                $numbers[] = $thisNumber;
                $last = $thisNumber;
            }
        }
        return $numbers;
    }
    /**
    * Returns the number of rows
    * 
    */
    public function numRows(){
        return ($this->maxPrime / 100);
    }
}
?>
