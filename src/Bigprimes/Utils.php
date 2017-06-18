<?php
namespace Bigprimes;

class Utils
{
    public function generate_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    //make sure there are no spaces, commas, character returns, line feeds in the number
    public function convert2Number($rawString){ 
      return str_replace([' ', ',', chr(13), chr(10)], '', $rawString);
    }

    public function is_even($n)
    {
        switch (substr($n, -1)) {
            case '0':
            case '2':
            case '4':
            case '6':
            case '8':
                return true;
            default:
                return false;
        }
    }


    public function is_palindrome($number)
    {
        $len = strlen($number);

        if($len === 1){
          return true;
        }

        $numberRev = strrev($number);

        if($this->is_even($len)){
          $l = $len >> 1;
          if(substr($number, $l) === substr($numberRev, $l)){
            return true;
          }
          return false;
        }else{
          $l = floor($len >> 1);
          if(substr($number, $l) === substr($numberRev, $l)){
            return true;
          }
          return false;
        }

        return null;
    }

    //decimal to babylonian numerals (base 60)
    public function dec2bab($n)
    {
        $values = [' &nbsp; &nbsp; &nbsp; '];
        for ($i = 1; $i < 60; $i++) {
            $values[] = '<img src="//static.bigprimes.net/imgs/babnumbers/bab_' . $i . '.gif" alt="' . $i . '">';
        }
        $val = '';
        while (($n != '0') && ($n != 0)) {
            $val = $values[bcmod($n, 60)] . " &nbsp; " . $val;
            $n = bcdiv($n, 60, 0);
        }
        return $val;
    }

}

