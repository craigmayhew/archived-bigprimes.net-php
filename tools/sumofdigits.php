<?php
class sumOfDigits{
    var $values=array();
    private $database;
    private $primes;
    public function __construct($primes,$database){
        $this->primes = $primes;
        $this->database = $database;
    }

    /**
    * Calculates the sum of all digits of the number between $start and $end
    * 
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
            if(count($sumofdigits)>50){
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
        $digits = (int)$digits;
        $sums = $this->database->fetchRows('sumOfDigits',array('sum','count'),"`digits`=$digits",'','`sum`');
        return $sums;
    }
}
