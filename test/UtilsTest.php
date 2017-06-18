<?php
use PHPUnit\Framework\TestCase;

namespace Bigprimes;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/Utils.php';

class UtilsTest extends \PHPUnit\Framework\TestCase
{

  public function test_generate_uuid()
  {
    $u = new Utils();
    $uuid = $u->generate_uuid();		

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
      $try = $u->convert2Number($in);		
      // Assert we have a cleaned up number without the commas and spaces etc
      $this->assertEquals($out, $try);
    }
  }
  
  public function test_is_even()
  {
    $u = new Utils();
    $numbers = [
                      '0'=>true,
                      '1'=>false,
                      '12'=>true,
                      '123'=>false,
                      '234'=>true,
                      '15'=>false,
                      '56'=>true,
                      '17'=>false,
                      '18'=>true,
                      '11111111111111111111119'=>false
                    ];

    foreach($numbers as $in=>$out){
      $try = $u->is_even($in);
      $this->assertEquals($out, $try);
    }
  }
 
  public function test_is_palindrome()
  {
    $u = new Utils();
    $numbers = [
                      '0'=>true,
                      '1'=>true,
                      '12'=>false,
                      '123'=>false,
                      '234'=>false,
                      '155555555555551'=>true,
                      '67777777777776'=>true,
                      '9999999999999999'=>true,
                      '11111111111111111111119'=>false
                    ];

    foreach($numbers as $in=>$out){
      $try = $u->is_palindrome($in);
      $this->assertEquals($out, $try);
    }
  }

 
}
