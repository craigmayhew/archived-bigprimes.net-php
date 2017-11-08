<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Squares extends TestCase
{
  public function test_isSquare()
  {
    $s = new \Bigprimes\Squares(new \stdClass());

    //positive matches
    $this->assertEquals('2', $s->isSquare(4));
    $this->assertEquals('3', $s->isSquare(9));
    $this->assertEquals('14', $s->isSquare(196));
    $this->assertEquals('20', $s->isSquare(400));
    $this->assertEquals('41', $s->isSquare(1681));
    $this->assertEquals('59', $s->isSquare(3481));
    
    //negative matches
    $this->assertEquals(false, $s->isSquare(7));
    $this->assertEquals(false, $s->isSquare(75));
    $this->assertEquals(false, $s->isSquare(208));
    $this->assertEquals(false, $s->isSquare(1472));
    $this->assertEquals(false, $s->isSquare(6632));
    $this->assertEquals(false, $s->isSquare(9481));
  }
}
