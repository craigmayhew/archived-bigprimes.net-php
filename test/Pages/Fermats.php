<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/Bigprimes/SumOfDigits.php';

class test_Pages_Fermats extends TestCase
{
	public function test_get()
	{
            $fermats = new \Bigprimes\Pages\Fermats(new \stdClass());
            $pageContent = $fermats->getContent();
            $this->assertContains('The Fermat Numbers', $pageContent);
	}
}
