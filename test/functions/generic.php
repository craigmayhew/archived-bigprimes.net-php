<?php
class functions_generic extends PHPUnit_Framework_TestCase
{
	public function test_safeXML()
	{
		$a = safeXML('&');
		
		// Assert
		$this->assertEquals('&amp;', $a);
	}
	public function test_generateString()
	{
		$len = 6;
		$str = generateString($len);
		// Assert
		$this->assertEquals($len,strlen($str));
	}
	public function test_getKey()
	{
		$arr = array(9,8,7,6);
		$a = getKey($arr,8);
		// Assert
		$this->assertEquals(1,$a);
        }
}
