<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Utils.php';

class UtilsTest extends TestCase
{

  public function test_generate_uuid()
  {
    $u = new Utils();
    $uuid = $u::generate_uuid();		

    // Assert uuid is 36 chars long
    $this->assertEquals(36, strlen($uuid));
  }

  public function test_convert2Number()
  {
    $u = new Utils();
    $messyNumbers = [
                      '123'=>'123',
                      '123 456'=>'123456',
                      '123,456'=>'123456',
                      '123'.chr(13).'456'=>'123456',
                      '123'.chr(10).'456'=>'123456'
                    ];

    foreach($messyNumbers as $in=>$out){
      $try = $u::convert2Number($in);		
      // Assert we have a cleaned up number without the commas and spaces etc
      $this->assertEquals($out, $try);
    }
  }
  
}
