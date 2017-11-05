<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/SumOfDigits.php';

class test_Perms extends TestCase
{
	public function test_factors_binary_perms()
	{
            $filePermisson = substr( sprintf( '%o', fileperms( 'src/Bigprimes/bin/factors' ) ), - 4 );
            $this->assertEquals( "0755", $filePermisson );
	}
}
