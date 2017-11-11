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
      $triangle = '1';
      $number = (string)$number;
      for ($i=2; -1===bccomp($triangle, $number); $i++) {
        $triangle = bcadd($triangle, $i);
      }
      if (0 === bccomp($triangle, $number)) {
        return $i-1;
      }
      return false;
    }
}
