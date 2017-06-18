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

}

