<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/Bigprimes/SumOfDigits.php';

class test_Rss_News extends TestCase
{

	public function test_get()
	{
            $rssNews = new \Bigprimes\Rss\News(new \stdClass());
            $pageContent = $rssNews->getContent();
            $this->assertContains('Site source code has been converted to PHP7', $pageContent);
	}

	public function test_buildXML()
	{
            $rssNews = new \Bigprimes\Rss\News(new \stdClass());
            $news = [
                      [
                        'description' => 'Site source code has been converted to PHP7 with Silex framework. Some methods have also been moved to cpp from PHP <a class="link" href="https://github.com/craigmayhew/bigprimes.net/">https://github.com/craigmayhew/bigprimes.net/</a>',
                        'date' => '13th November 2016',
                        'title' => 'title',
                        'link' => 'http://testLink.bigprimes.net/'
                      ]
                    ];

            $pageContent = $rssNews->buildXML($news, 
                                              $testTitle = 'testTitle',
                                              $testLink = 'http://testLink.bigprimes.net',
                                              $testDescription = 'testDescription', 
                                              $testImg = 'testimage');
            $this->assertContains('Site source code has been converted to PHP7', $pageContent);
            $this->assertContains($testTitle, $pageContent);
            $this->assertContains($testLink, $pageContent);
            $this->assertContains($testDescription, $pageContent);
            $this->assertContains($testImg, $pageContent);
	}

}
