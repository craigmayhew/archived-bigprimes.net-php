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
      //check numbers that we can calcualte as integers
      if (-1===bccomp((string)$number, (string)1000000000)) {
        $triangle = 1;
        $number = (int)$number;
        for ($i=2; $triangle < $number; $i++) {
          $triangle += $i;
        }
        if ($triangle === $number) {
          return $i-1;
        }
        return false;
      }

      $triangle = 1;
      $number = (string)$number;
      for ($i=2; $i<1000000000 && -1===bccomp((string)$triangle, $number); $i++) {
        $triangle += $i;
      }
      if (0 === bccomp((string)$triangle, $number)) {
        return $i-1;
      }

      for ($j=$i; -1===bccomp($triangle, $number); $j++) {
        $triangle = bcadd($triangle, $j);
      }
      if (0 === bccomp($triangle, $number)) {
        return $j-1;
      }
      return false;
    }
}
