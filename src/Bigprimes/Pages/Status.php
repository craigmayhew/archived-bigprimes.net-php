<?php
namespace Bigprimes\Pages;

class Status extends \Bigprimes\Pages
{

    public function getContent()
    {

        $return =
            '<h1>Status</h1>' .
            '<table cellpadding="3" cellspacing="0" border="1" class="text" bgcolor="#e0faed">' .
            '<tr>' .
            '<td width="200">Number of verified primes:</td>' .
            '<td width="100">1.4 billion</td>' .
            '</tr>' .
            '<tr>' .
            '<td width="200">Storage Used:</td>' .
            '<td width="100">~2GB</td>' .
            '</tr>' .
            '</table>';

        return
            $return;
    }
}
