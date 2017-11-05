<?php
namespace Bigprimes\Pages;

class Downloads extends \Bigprimes\Pages
{
    public function getContent()
    {
        $downloads = [
            [
                'title' => 'All 44 known Mersenne primes',
                'link' => '//static.bigprimes.net/archive/mersenne/Mersenne Primes'
            ],
            [
                'title' => 'All 12 factored Fermat numbers',
                'link' => '//static.bigprimes.net/archive/fermat/Fermat Numbers'
            ],
            [
                'title' => 'All 44 known perfect numbers',
                'link' => '//static.bigprimes.net/archive/perfect/Perfect Numbers'
            ]
        ];

        $return =
            '<h1>Downloads</h1>' .
            '<table cellpadding="2" cellspacing="0" class="text table" bgcolor="#e0faed">' .
            '<tr>' .
            '<td width="200">&nbsp;</td>' .
            '<td width="20">Zip</td>' .
            '</tr>';
        foreach ($downloads as $value) {
            $return .=
                '<tr>' .
                '<td align="left">' . $value['title'] . '</td>' .
                '<td style="white-space: nowrap;">' .
                '<a href="' . $value['link'] . '.zip" class="link"><img src="//static.bigprimes.net/imgs/file_types/zip_20.gif" alt="" /></a>' .
                '</td>' .
                '</tr>';
        }

        $return .=
            '</table>' .
            '<br /><br />';

        return
            $return;
    }
}
