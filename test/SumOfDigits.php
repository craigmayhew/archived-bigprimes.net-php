<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_SumOfDigits extends TestCase
{
  public function test_Construct()
  {
    $s = new \Bigprimes\SumOfDigits(new \stdClass(), new \stdClass());

    //positive matches
    $this->assertInternalType('object', $s);
  }
}
