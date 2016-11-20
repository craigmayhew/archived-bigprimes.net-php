<?php
class functions_generic extends PHPUnit_Framework_TestCase
{
	public function test_safeXML()
	{
		$a = safeXML('&');
		
		// Assert
		$this->assertEquals('&amp;', $a);
	}
}
