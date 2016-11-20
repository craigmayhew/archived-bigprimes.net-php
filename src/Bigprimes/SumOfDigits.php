<?php
namespace Bigprimes;

class SumOfDigits{
    private $app;
    private $primes;
    public function __construct($primes,$app){
        $this->app = $app;
        $this->primes = $primes;
    }

    /**
    * Calculates the sum of all digits of the number between $start and $end
    * Should only be run from command line, do not allow multiple instances of this to run simultaneously
    * 
    * @param mixed $start Starting number.
    * @param mixed $end Ending number.
    */
    public function calc(){
        set_time_limit(0);
        $sumofdigits = array();
        for($i=1;$i<510001;$i++){
            $numbers = $this->primes->primeSet($i);
            foreach($numbers as $number){
                $number = (string)$number;
                $len = strlen($number);
                $sum = 0;
                for($i2=0;$i2<$len;$i2++){
                    $sum += (int)$number[$i2];
                }
                $key = $len.'-'.$sum;
                if(!isset($sumofdigits[$key])){
                    $sumofdigits[$key] = array(
                        'len'=>(int)$len,
                        'sum'=>(int)$sum,
                        'count'=>1
                    );
                }else{
                    $sumofdigits[$key]['count']++;
                }
            }
            if(count($sumofdigits)>50){
                $this->addToDatabase($sumofdigits);
                $sumofdigits = array();
            }
        }
        $this->addToDatabase($sumofdigits);
    }
    private function addToDatabase($sumofdigits){
        foreach($sumofdigits as &$sum){
            $sql = 'SELECT `count` FROM `bigprimes`.`sumOfDigits` WHERE `digits` = ? AND `sum` = ?';
            $count = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array($sum['len'], $sum['sum']));

            if($count['count'] && $count['count']>0){
                $sql = "UPDATE sumOfDigits SET `count`=`count`+ ?  WHERE `digits`= ? AND `sum`= ?";
                $this->app['dbs']['mysql_write']->executeUpdate($sql, array($sum['count'], $sum['len'], $sum['sum']));
            }else{
                $this->app['dbs']['mysql_write']->insert('sumOfDigits', array(
                    'digits' => $sum['len'],
                    'sum' => $sum['sum'],
                    'count' => $sum['count']
                ));
            }
        }
    }
    public function get($digits){
        $digits = (int)$digits;
        $sql = 'SELECT `sum`,`count` FROM `bigprimes`.`sumOfDigits` WHERE `digits` = ? ORDER BY sum';
        $sums = $this->app['dbs']['mysql_read']->fetchAll($sql, array($digits));
 
        return $sums;
    }
}

