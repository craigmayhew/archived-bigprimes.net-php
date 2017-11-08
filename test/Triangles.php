<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Triangles extends TestCase
{
  public function test_isTriangle()
  {
    $s = new \Bigprimes\Triangles(new \stdClass());

    //positive matches
    $this->assertEquals('1', $s->isTriangle(1));
    $this->assertEquals('2', $s->isTriangle(3));
    $this->assertEquals('3', $s->isTriangle(6));
    $this->assertEquals('4', $s->isTriangle(10));
    $this->assertEquals('9', $s->isTriangle(45));
    $this->assertEquals('100', $s->isTriangle(5050));
    
    //negative matches
    $this->assertEquals(false, $s->isTriangle(7));
    $this->assertEquals(false, $s->isTriangle(75));
    $this->assertEquals(false, $s->isTriangle(208));
    $this->assertEquals(false, $s->isTriangle(1472));
    $this->assertEquals(false, $s->isTriangle(6632));
    $this->assertEquals(false, $s->isTriangle(9481));
  }
}
