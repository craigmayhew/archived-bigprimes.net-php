<?php
namespace Bigprimes\Pages;

class Fermats extends \Bigprimes\Pages
{

    public function getContent()
    {
      $header = ['&nbsp;', 'No.', 'Fermat', 'Digits', 'Prime / Factors', 'Download'];

      $data = 
      [
        ['&nbsp;', '11', '2<sup>2048</sup>+1', '', '<a href="/cruncher/319489/">P27567</a> &times; 974849 &times; 167988556341760475137 &times; 3560841906445833920513 &times; <a href="/cruncher/4093/">P564</a>', ''],
        ['&nbsp;', '10', '2<sup>1024</sup>+1', '', '45592577 &times; 6487031809 &times; 4659775785220018543264560743076778192897 &times; <a href="/cruncher/1601/">P252</a>', ''],
        ['&nbsp;', '9', '2<sup>512</sup>+1', '155', '2424833 &times; 7455602825647884208337395736200454918783366342657 &times; <a href="/cruncher/523/">P99</a>', '<a href="//static.bigprimes.net/archive/fermat/F9.txt">TXT</a>'],
        ['&nbsp;', '8', '2<sup>256</sup>+1', '78', '1238926361552897 &times; <a href="/cruncher/293/">P62</a>', '<a href="//static.bigprimes.net/archive/fermat/F8.txt">TXT</a>'],
        ['&nbsp;', '7', '2<sup>128</sup>+1', '39', '59649589127497217 &times; 5704689200685129054721', '<a href="//static.bigprimes.net/archive/fermat/F7.txt">TXT</a>'],
        ['&nbsp;', '6', '2<sup>64</sup>+1', '20', '274177 &times; 67280421310721', '<a href="//static.bigprimes.net/archive/fermat/F6.txt">TXT</a>'],
        ['&nbsp;', '5', '2<sup>32</sup>+1', '10', '641 &times; 6700417', '<a href="//static.bigprimes.net/archive/fermat/F5.txt">TXT</a>'],
        ['&nbsp;', '4', '2<sup>16</sup>+1', '5', '6543rd Prime', '<a href="//static.bigprimes.net/archive/fermat/F4.txt">TXT</a>'],
        ['&nbsp;', '3', '2<sup>8</sup>+1', '3', '55th Prime', '<a href="//static.bigprimes.net/archive/fermat/F3.txt">TXT</a>'],
        ['&nbsp;', '2', '2<sup>4</sup>+1', '2', '7th Prime', '<a href="//static.bigprimes.net/archive/fermat/F2.txt">TXT</a>'],
        ['&nbsp;', '1', '2<sup>2</sup>+1', '1', '3rd Prime', '<a href="//static.bigprimes.net/archive/fermat/F1.txt">TXT</a>'],
        ['&nbsp;', '0', '2<sup>1</sup>+1', '1', '2nd Prime', '<a href="//static.bigprimes.net/archive/fermat/F0.txt">TXT</a>']
      ];

      $return = 
      '<style>'.
        '#tbl tr th, #tbl tr td {background-color: #fff; border: 0;}'.
        '#tbl tr th, #tbl tr td {padding: 2px 12px 2px 12px; text-align: left;}'.
        '#tbl tr td:nth-child(1) {width: 28px;}'.
        '#tbl tr td:nth-child(2) {width: 70px;}'.
        '#tbl tr td:nth-child(3) {width: 70px;}'.
        '#tbl tr td:nth-child(4) {width: 90px;}'.
        '#tbl tr td:nth-child(5) {width: 130px;}'.
        '#tbl tr td:nth-child(6) {width: 130px;}'.
      '</style>'.
      '<h1>The Fermat Numbers</h1>'.
      '<br>';
      $table = new \Bigprimes\Table($this->app, $data, $header);
      $return .= $table->getHTML(false, false);
      return $return;
    }
}

