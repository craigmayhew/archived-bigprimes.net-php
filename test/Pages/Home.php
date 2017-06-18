<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/Bigprimes/SumOfDigits.php';

class test_Pages_Home extends TestCase
{
	public function test_get()
	{
            $fermats = new \Bigprimes\Pages\Home(new \stdClass());
            $pageContent = $fermats->getContent();
            $this->assertContains('13th November 2016', $pageContent);
            $this->assertContains('13th May 2005', $pageContent);
	}
}
