<?php
namespace Bigprimes;

class Triangles
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
    
    //check if a number is a triangle number or not. if not then return false.
    //if true return which triangle number it is
    public function is_triangle($num)
    {
        $n = 2;
        $n_too_small = 1;
        $n_too_big = $num;
        $j = 0;
        while (!(((($n * ($n + 1)) / 2) < $num) AND ($num < ((($n - 1) * $n) / 2)))) {
            $formula = (($n * ($n + 1)) / 2);
            if ($formula < $num) { //if its too small
                if ((($n + 1 * ($n + 2)) / 2) > $num) {
                    return false;
                }
                $n_too_small = $n;
                $n = round(abs(mt_rand($n_too_small, $n_too_big)), 0);
            } elseif ($formula > $num) { //if its too big
                if (((($n - 1) * $n) / 2) < $num) {
                    return false;
                }
                $n_too_big = $n;
                $n = round(abs(mt_rand($n_too_small, $n_too_big)), 0);
            } else { // its a triangle number!!!
                return $n;
            }
        }
        return false;
    }
}
