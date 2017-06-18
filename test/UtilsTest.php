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
                      '1553551'=>true,
                      '67777777777776'=>true,
                      '9999999999999999'=>true,
                      '11111111111111111111119'=>false
                    ];

    foreach($numbers as $in=>$out){
      $try = $u->is_palindrome($in);
      $this->assertEquals($out, $try);
    }
  }

  //decimal to babylonian numerals (base 60)
  public function test_dec2bab()
  {
    $u = new Utils();
    $numbers = [
                      '1'=>'<img src="//static.bigprimes.net/imgs/babnumbers/bab_1.gif" alt="1"> &nbsp; ',
                      '12'=>'<img src="//static.bigprimes.net/imgs/babnumbers/bab_12.gif" alt="12"> &nbsp; ',
                      '123'=>'<img src="//static.bigprimes.net/imgs/babnumbers/bab_2.gif" alt="2"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_3.gif" alt="3"> &nbsp; ',
                      '234'=>'<img src="//static.bigprimes.net/imgs/babnumbers/bab_3.gif" alt="3"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_54.gif" alt="54"> &nbsp; ',
                      '911111111119'=>'<img src="//static.bigprimes.net/imgs/babnumbers/bab_19.gif" alt="19"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_31.gif" alt="31"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_41.gif" alt="41"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_46.gif" alt="46"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_59.gif" alt="59"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_45.gif" alt="45"> &nbsp; <img src="//static.bigprimes.net/imgs/babnumbers/bab_19.gif" alt="19"> &nbsp; '
                    ];

    foreach($numbers as $in=>$out){
      $try = $u->dec2bab($in);
      $this->assertEquals($out, $try);
    }
  }

  public function test_dec2base(){
    $u = new Utils();
    
    $numbers = [
      '2' => ['1'=>'1', '123'=>'1111011'],
      '3' => ['1'=>'1', '123'=>'11120'],
      '4' => ['1'=>'1', '123'=>'1323'],
      '5' => ['1'=>'1', '123'=>'443'],
      '8' => ['1'=>'1', '123'=>'173'],
      '16' => ['1'=>'1', '123'=>'7B', '999999999999999999'=>'DE0B6B3A763FFFF']
    ];

    foreach($numbers as $base => $v){
      foreach($v as $in => $out){
        $try = $u->dec2base($in, $base);
        $this->assertEquals($out, $try);
      }
    }
  }
 
}
