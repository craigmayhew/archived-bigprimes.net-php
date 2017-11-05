<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';

class test_Pages_Primalitytests extends TestCase
{
	public function test_get()
	{
            $ptest = new \Bigprimes\Pages\Primalitytest(new \stdClass());
            $pageContent = $ptest->getContent();
            $this->assertContains('This will show <input', $pageContent);
	}
}
