<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Pages.php';

class test_Table extends TestCase
{
	public function test_getHTML()
	{
            $data = 
            [
              ['COLUMN HEADER 1'=>'DATA 1', 'COLUMN HEADER 2'=>'DATA 2'],
              ['COLUMN HEADER 1'=>'DATA 3', 'COLUMN HEADER 2'=>'DATA 4'],
              ['COLUMN HEADER 1'=>'DATA 5', 'COLUMN HEADER 2'=>'DATA 6']
            ];
            
            $table = new \Bigprimes\Table(new \stdClass(), $data);
            $content = $table->getHTML('50 awesome numbers', '70 amazing numbers');

            $this->assertRegexp('/Previous 50 awesome numbers/', $content);
            $this->assertRegexp('/Next 70 amazing numbers/', $content);
            $this->assertRegexp('/<tr><th>COLUMN HEADER 1<\/th><th>COLUMN HEADER 2<\/th><\/tr>/', $content);
            $this->assertRegexp('/<tr><td>DATA 1<\/td><td>DATA 2<\/td><\/tr>/', $content);
            $this->assertRegexp('/<tr><td>DATA 5<\/td><td>DATA 6<\/td><\/tr>/', $content);
	}
}
