<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Primes extends TestCase
{
  
  public function test_cpuCheckNthPrime()
  {
    $p = new \Bigprimes\Primes(new \stdClass());
    $this->assertEquals(3, $p->cpuCheckNthPrime('5'));
    $this->assertEquals(7, $p->cpuCheckNthPrime('17'));
    $this->assertEquals(42, $p->cpuCheckNthPrime('181'));
    $this->assertEquals(821, $p->cpuCheckNthPrime('6311'));
    $this->assertEquals(7950, $p->cpuCheckNthPrime('81223'));
  }
}
