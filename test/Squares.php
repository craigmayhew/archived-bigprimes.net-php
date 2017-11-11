<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Squares extends TestCase
{

  public function test_nthSquare()
  {
    $s = new \Bigprimes\Squares(new \stdClass());

    //positive matches
    $this->assertEquals(true, $s->isSquare(4, 2));
    $this->assertEquals(true, $s->isSquare(9, 2));
    $this->assertEquals(true, $s->isSquare(196, 3));
    $this->assertEquals(true, $s->isSquare(400, 4));
    $this->assertEquals(true, $s->isSquare(1681, 4));
    $this->assertEquals(true, $s->isSquare(3481, 4));
    
    //negative matches
    $this->assertEquals(false, $s->isSquare(7, 2));
    $this->assertEquals(false, $s->isSquare(75, 2));
    $this->assertEquals(false, $s->isSquare(208, 3));
    $this->assertEquals(false, $s->isSquare(1472, 4));
    $this->assertEquals(false, $s->isSquare(6632, 4));
    $this->assertEquals(false, $s->isSquare(9481, 4));
  }

  public function test_isSquare()
  {
    $s = new \Bigprimes\Squares(new \stdClass());

    //positive matches
    $this->assertEquals('2', $s->nthSquare(4, 2));
    $this->assertEquals('3', $s->nthSquare(9, 2));
    $this->assertEquals('14', $s->nthSquare(196, 3));
    $this->assertEquals('20', $s->nthSquare(400, 4));
    $this->assertEquals('41', $s->nthSquare(1681, 4));
    $this->assertEquals('59', $s->nthSquare(3481, 4));
    
    //negative matches
    $this->assertEquals(false, $s->nthSquare(7, 2));
    $this->assertEquals(false, $s->nthSquare(75, 2));
    $this->assertEquals(false, $s->nthSquare(208, 3));
    $this->assertEquals(false, $s->nthSquare(1472, 4));
    $this->assertEquals(false, $s->nthSquare(6632, 4));
    $this->assertEquals(false, $s->nthSquare(9481, 4));
  }
}
