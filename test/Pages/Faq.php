<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/Bigprimes/SumOfDigits.php';

class test_Pages_Faq extends TestCase
{
        public function test_get()
        {
            $faq = new \Bigprimes\Pages\Faq(new \stdClass());
            $pageContent = $faq->getContent();
            $this->assertContains('Please try our', $pageContent);
            $this->assertContains('bug/mistake', $pageContent);
        }
}
