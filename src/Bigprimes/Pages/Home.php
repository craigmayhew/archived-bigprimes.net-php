<?php
namespace Bigprimes\Pages;

class Home extends \Bigprimes\Pages
{
    public function getContent()
    {
        $news = \Bigprimes\Rss\News::$news;

        $return =
            '<br><br>' .
            '<table cellpadding="3" cellspacing="0" border="1" class="text" bgcolor="#E0FAED" style="width:80%;">' .
            '<tr>' .
            '<td width="100">Date</td>' .
            '<td width="300">News</td>' .
            '</tr>';
        foreach ($news as $item) {
            $return .=
                '<tr>' .
                '<td>' . $item['date'] . '</td>' .
                '<td>' . $item['description'] . '</td>' .
                '</tr>';
        }
        $return .=
            '</table>';

        return
            $return;
    }
}
