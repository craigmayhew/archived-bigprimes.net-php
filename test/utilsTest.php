<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/utils.php';

class test_utils extends TestCase
{
	public function test_generate_uuid()
	{
		$u = new utils();
                $uuid = $u::generate_uuid();		

		// Assert uuid is 36 chars long
		$this->assertEquals(36, strlen($uuid));
	}
}
