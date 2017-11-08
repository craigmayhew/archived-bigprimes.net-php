<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Pages extends TestCase
{
	public function test_stndrd()
	{
            $p = new \Bigprimes\Pages(new \stdClass());

            $this->assertEquals('1st', $p->stndrd(1));
            $this->assertEquals('2nd', $p->stndrd(2));
            $this->assertEquals('3rd', $p->stndrd(3));
            $this->assertEquals('4th', $p->stndrd(4));
            $this->assertEquals('5th', $p->stndrd(5));
            $this->assertEquals('10th', $p->stndrd(10));
            $this->assertEquals('19th', $p->stndrd(19));
            $this->assertEquals('723rd', $p->stndrd(723));
            $this->assertEquals('1463rd', $p->stndrd(1463));
	}

        public function test_getHeader() {
            $p = new \Bigprimes\Pages(new \stdClass());
            
            //generate random strings
            $title = sha1(rand().microtime());
            $metaTagDescription = sha1(rand().microtime());
            $metaTagKeywords = sha1(rand().microtime());
            
            $header = $p->getHeader($title, $metaTagDescription, $metaTagKeywords);
            
            $this->assertContains($title, $header);
            $this->assertContains($metaTagDescription, $header);
            $this->assertContains($metaTagKeywords, $header);
        }
        
        public function test_getFooter() {
            $p = new \Bigprimes\Pages(new \stdClass());

            $footer = $p->getFooter();

            $this->assertContains('div', $footer);
        }
}
