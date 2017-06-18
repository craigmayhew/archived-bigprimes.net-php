<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/Bigprimes/SumOfDigits.php';

class test_Pages_Perfects extends TestCase
{
	public function test_get()
	{
            $fermats = new \Bigprimes\Pages\Perfects(new \stdClass());
            $pageContent = $fermats->getContent();
            $this->assertContains('<h1>Perfect Numbers</h1>', $pageContent);
	}
}
