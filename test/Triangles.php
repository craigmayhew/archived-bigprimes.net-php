<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Triangles extends TestCase
{
  public function test_nthTriangle()
  {
    $s = new \Bigprimes\Triangles(new \stdClass());

    //positive matches
    $this->assertEquals('1', $s->nthTriangle(1));
    $this->assertEquals('2', $s->nthTriangle(3));
    $this->assertEquals('3', $s->nthTriangle(6));
    $this->assertEquals('4', $s->nthTriangle(10));
    $this->assertEquals('9', $s->nthTriangle(45));
    $this->assertEquals('100', $s->nthTriangle(5050));
    
    //negative matches
    $this->assertEquals(false, $s->nthTriangle(7));
    $this->assertEquals(false, $s->nthTriangle(75));
    $this->assertEquals(false, $s->nthTriangle(208));
    $this->assertEquals(false, $s->nthTriangle(1472));
    $this->assertEquals(false, $s->nthTriangle(6632));
    $this->assertEquals(false, $s->nthTriangle(9481));
  }
}
