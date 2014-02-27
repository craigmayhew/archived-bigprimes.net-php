<?php
class sumOfDigits{
    var $primes;
    var $database;
    var $values=array();
    public function __construct(&$primes,&$database){
        $this->primes = &$primes;
        $this->database = &$database;
    }

    /**
    * Calculates the sum of all digits of the number between $start and $end
    * 
    * @param mixed $start Starting number.
    * @param mixed $end Ending number.
    */
    public function calc(){
        set_time_limit(0);
        $sumofdigits = array();
        for($i=1;$i<510001;$i++){
            $numbers = $this->primes->primeSet($i);
            foreach($numbers as &$number){
                $number = (string)$number;
                $len = strlen($number);
                $sum = 0;
                for($i2=0;$i2<$len;$i2++){
                    $sum += (int)$number[$i2];
                }
                if(!isset($sumofdigits[$len.'-'.$sum])){
                    $sumofdigits[$len.'-'.$sum] = array(
                        'len'=>(int)$len,
                        'sum'=>(int)$sum,
                        'count'=>1
                    );
                }else{
                    $sumofdigits[$len.'-'.$sum]['count']++;
                }
            }
            //echo count($sumofdigits),'<br>';
            //ob_flush();
            if(count($sumofdigits)>50){
                //pr($sumofdigits);
                $this->addToDatabase($sumofdigits);
                $sumofdigits = array();
            }
        }
        $this->addToDatabase($sumofdigits);
    }
    private function addToDatabase(&$sumofdigits){
        foreach($sumofdigits as &$sum){
            if($this->database->count('sumOfDigits',"`digits`={$sum['len']} AND `sum`={$sum['sum']}")){
                $this->database->query("UPDATE `sumOfDigits` SET `count`=`count`+".$sum['count']." WHERE `digits`={$sum['len']} AND `sum`={$sum['sum']}");
            }else{
                $this->database->insert('sumOfDigits',array('digits','sum','count'),array($sum['len'],$sum['sum'],$sum['count']));
            }
        }
    }
    public function get($digits){
        global $database;
        $digits = (int)$digits;
        $sums = $database->fetchRows('sumOfDigits',array('sum','count'),"`digits`=$digits",'','`sum`');
        return $sums;
    }
}
?>