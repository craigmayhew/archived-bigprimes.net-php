<?php
namespace Bigprimes\Pages;

class Fibonaccis extends \Bigprimes\Pages
{
    public function getContent($num = 0)
    {
        $num = (int)abs($num);

        $sql = 'SELECT MAX(id) as `count` FROM fibonacci_numbers WHERE 1';
        $count = $this->app['dbs']['mysql_read']->fetchAssoc($sql, []);
        $count = $count['count'];

        $return = '<h1>Fibonacci Archive</h1>';

        if ($count >= $num) {
            $numleft = $count - $num;

            $return .=
            'This page shows the ' . $this->stndrd($num + 1) . ' fibonacci number'.
            ' followed by the next ' . ($numleft < 24 ? $numleft : 24).
            '.<br /><br />'.
            '<style>'.
              '#tbl tr th, #tbl tr td {background-color: #fff; border: 0;}'.
              '#tbl tr th, #tbl tr td {padding: 2px 12px 2px 12px; text-align: left;}'.
            '</style>';
            
            $sql = 'SELECT number FROM fibonacci_numbers WHERE (id > ?) AND (id < ?)';
            $fibs = $this->app['dbs']['mysql_read']->fetchAll($sql, [$num - 1, $num + 25]);
            $data = [];
            foreach ($fibs as $row) {
                $data[] = ['<a class="link" href="/cruncher/' . $row['number'] . '/">' . $row['number'] . '</a>'];
            }

            $table = new \Bigprimes\Table($this->app, $data);
            $return .= $table->getHTML(false, false);

            $return .=
            '<br /><br />' .
            '<table cellpadding="0" cellspacing="0" border="0">' .
              '<tr>' .
                '<td align="left" class="primeTableCell" width="180">';
                if (($num - 25) >= 0) {
                  $return .=
                  '<a class="link" href="/archive/fibonacci/' . ($num - 25) . '/">previous 25 fibonacci numbers</a>';
                }
                $return .=
                '</td>' .
                '<td align="right" class="primeTableCell" width="180">';
                if (($num + 25) <= $count) {
                  $return .=
                  '<a class="link" href="/archive/fibonacci/' . ($num + 25) . '/">next 25 fibonacci numbers</a>';
                }
                $return .=
                '</td>'.
              '</tr>'.
            '</table>';
        } else {
          $return .= 'We can\'t find the ' . $this->stndrd($num) . ' fibonacci number in our database.';
        }

        $return .=
        '<br /><br /><br />' .
        'Display the <input id="num" type="text" value="" /> fibonacci number <button type="button" onclick="window.location.href=\'https://www.bigprimes.net/archive/fibonacci/\'+$(\'#num\').val()+\'/\'">Go</button>' .
        '<br /><br /><br />' .
        '<a class="link" href="/archive/fibonacci/100/">100th Fibonacci Number</a><br />' .
        '<a class="link" href="/archive/fibonacci/1000/">1000th Fibonacci Number</a><br />' .
        '<a class="link" href="/archive/fibonacci/10000/">10000th Fibonacci Number</a><br />' .
        '<a class="link" href="/archive/fibonacci/' . $count . '/">Our Biggest Fibonacci Number</a><br />';

        return $return;
    }
}
