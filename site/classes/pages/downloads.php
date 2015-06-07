<?php
namespace pages;

class downloads extends \pages{
  function getContent(){
    $return = '';

    $downloads = array(
      array(
        'title' => 'All 44 known Mersenne primes',
        'description' => 'This contains the first 44 Mersenne prime numbers.',
        'link' => 'archive/mersenne/Mersenne Primes',
        'sizezip' => '23.58MB'
      ),
      array(
        'title' => 'All 12 factored Fermat numbers',
        'description' => 'This contains the first 12 Fermat numbers.',
        'link' => 'archive/fermat/Fermat Numbers',
        'sizezip' => '1.12KB'
      ),
      array(
        'title' => 'All 44 known perfect numbers',
        'description' => 'This contains the first 44 perfect numbers.',
        'link' => 'archive/perfect/Perfect Numbers',
        'sizezip' => '48.13MB'
      )
    );

    $return .=
    '<h1>Downloads</h1>'.
    '<table cellpadding="2" cellspacing="0" class="text table" bgcolor="#e0faed">'.
    '<tr>'.
      '<td width="200">&nbsp;</td>'.
      '<td width="200">&nbsp;</td>'.
      '<td width="70">Zip</td>'.
      '<td width="70">7Zip</td>'.
    '</tr>';
    foreach ($downloads as $k => $value){
      $return .=
      '<tr>'.
        '<td align="left">'.$value['title'].'</td>'.
        '<td align="left">'.$value['description'].'</td>'.
        '<td style="white-space: nowrap;">';
          '<a href="http://static.bigprimes.net/'.$value['link'].'.zip" class="link">'.
            '<img src="http://static.bigprimes.net/imgs/file_types/zip_20.gif" alt="" />&nbsp;('.$value['size'].')'.
          '</a>';
        '</td>'.
        '<td>'.
          'N/A'.
        '</td>'.
      '</tr>';
    }
    $return .=
    '</table>'.
    '<br /><br />';

    return
    $return;
  }
}
