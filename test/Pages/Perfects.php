<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';

class test_Pages_Perfects extends TestCase
{
	public function test_get()
	{
            $perfects = new \Bigprimes\Pages\Perfects(new \stdClass());
            $pageContent = $perfects->getContent();
            $this->assertContains('<h1>Perfect Numbers</h1>', $pageContent);
	}
}
