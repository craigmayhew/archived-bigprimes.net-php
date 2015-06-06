<?php
class functions_numbers extends PHPUnit_Framework_TestCase
{
        public function test_randThousand()
        {
                $a = randThousand();
		
                // Assert
		$this->assertLessThan(1000, $a);
		$this->assertLessThan($a, -1);
	}
}
