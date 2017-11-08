<?php
namespace Bigprimes;

class Squares
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function isSquare($number)
    {
      $square = '1';
      $number = (string)$number;
      for ($i=1; -1===bccomp($square, $number); $i++) {
        $square = bcmul($i, $i);
      }
      if (0 === bccomp($square, $number)) {
        return $i-1;
      }
      return false;
    }
}
