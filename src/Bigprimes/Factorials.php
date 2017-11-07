<?php
namespace Bigprimes;

class Factorials
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function bcfact($n){
      if ((string)$n === '0') {
        return '1';
      }

      $factorial = (string)$n;
      while (--$n > 1) {
        $factorial = bcmul($factorial, (string)$n);
      }
      return $factorial;
    }

    /*
     *
     */
    public function isFactorial($number)
    {
      $f = 1;
      for ($attempt = 1; $f <= $number; $attempt++) {
        $f = $this->bcfact($attempt);
        if ($f === $number) {
          return $attempt;
        }
      }
      return false; 
    }
    
}
