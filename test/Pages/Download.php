<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/Bigprimes/SumOfDigits.php';

class test_Pages_Downloads extends TestCase
{
  public function test_get()
  {
    $downloads = new \Bigprimes\Pages\Downloads(new \stdClass());
    $pageContent = $downloads->getContent();
    $this->assertContains('All 44 known Mersenne primes', $pageContent);
    $this->assertContains('All 12 factored Fermat numbers', $pageContent);
    $this->assertContains('All 44 known perfect numbers', $pageContent);
  }
}
