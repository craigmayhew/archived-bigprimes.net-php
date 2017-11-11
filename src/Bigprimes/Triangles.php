<?php
namespace Bigprimes;

class Triangles
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
   
    public function nthTriangle($number)
    {
      if (!is_string($number)) {
        return null;
      }
 
      //t = (n(n+1))/2
      $tooSmall = '0';
      $tooLarge = bcadd('1', $number, 0);
      $numLen = strlen($number);
      while (true) {
        //pick a number between our range
        $rand = mt_rand() / mt_getrandmax();

        $n = bcadd(bcmul(bcsub($tooLarge, $tooSmall), (string)$rand), $tooSmall, 0); 

        //work out the nth triangle number for our attempt
        $tn = bcdiv(bcmul($n, bcadd($n, 1, 0), 0), '2', 0);
        //compare $tn to our number
        $tnCompare = bccomp($tn, $number, $numLen);
        // if $tn is the triangle number we seek
        if (0 === $tnCompare) {
          return $n;
        //if $tn is smaller than the triangle number we seek
        } elseif (-1 === $tnCompare){
          // if our number is smaller than the number we are checking, but larger than our small attempt
          if (1 === bccomp($n, $tooSmall, $numLen)) {
            $tooSmall = $n;
          }
        //if $tn is larger than the triangle number we seek
        } else {
          // if our number is larger than the number we are checking, but smaller than our largest attempt
          if (-1 === bccomp($n, $tooLarge, $numLen)) {
            $tooLarge = $n;
          }
        }
        //return false if we have exausted the whole range of possible answers
        if (0===bccomp(bcadd($tooSmall,'1',0), $tooLarge, $numLen)) {
          return false;
        }
      }
      return false;
    }
}
