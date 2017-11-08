<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Primes extends TestCase
{
  public function test_prob_prime()
  {
    $p = new \Bigprimes\Primes(new \stdClass());

    // prime checks
    $this->assertEquals(true, $p->prob_prime('2'));
    $this->assertEquals(true, $p->prob_prime('7'));
    $this->assertEquals(true, $p->prob_prime('39850859372740856242099725857146778412298219829168807875828109446556425650123663580223371858956633234197793823836800702258795237043648054470513616206175403378621362265360297207018853335998176098526621'));
    // none primes
    $this->assertEquals(false, $p->prob_prime('90'));
    // known false positives:
    $this->assertEquals(true, $p->prob_prime('427'));
  }
  
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
