<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Primes extends TestCase
{
  public function test_factorial()
  {
    $p = new \Bigprimes\Primes(new \stdClass());

    $this->assertEquals('1', $p->bcfact(0));
    $this->assertEquals('1', $p->bcfact(1));
    $this->assertEquals('2', $p->bcfact(2));
    $this->assertEquals('6', $p->bcfact(3));
    $this->assertEquals('24', $p->bcfact(4));
    $this->assertEquals('15882455415227429404253703127090772871724410234473563207581748318444567162948183030959960131517678520479243672638179990208521148623422266876757623911219200000000000000000000000000', $p->bcfact(110));

    $this->assertEquals('1', $p->isFactorial('1'));
    $this->assertEquals('2', $p->isFactorial('2'));
    $this->assertEquals('3', $p->isFactorial('6'));
    $this->assertEquals('4', $p->isFactorial('24'));
    $this->assertEquals('110', $p->isFactorial('15882455415227429404253703127090772871724410234473563207581748318444567162948183030959960131517678520479243672638179990208521148623422266876757623911219200000000000000000000000000'));
  }

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
}
