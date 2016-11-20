<?php
namespace pages;

class fibonacci extends \pages{
  function getContent(){
    $return = '';

    $num = isset($_GET['num'])?(int)$_GET['num']:0;
    if ($num < 0){
      $num = 0;
    }

    $count = $database->count('fibonacci_numbers');

    if ($count >= $num){
      $return .= 
      '<h1>Fibonacci Archive</h1>'.
      ' This page shows the '.numbers::stndrd($num+1).' fibonacci number';
      $numleft = $count - $num;
      if ($numleft == 0){
      
      }elseif ($numleft < 24){
        $return .=
        ' followed by the next '.$numleft;
      }else{
        $return .=
        ' followed by the next 24';
      }
      
      $return .=
      '.<br /><br />';
      
      $query = mysql_query('SELECT number FROM fibonacci_numbers WHERE (id > '.($num-1).') AND (id < '.($num+25).')');
      
      $return .=
      '<table cellpadding="0" cellspacing="0" border="0" class="text">'.
        '<tr>'.
          '<td>';
            while ($row = mysql_fetch_array($query,MYSQL_ASSOC)){
              $return .= '<a class="link" href="/number/">'.$row['number'].'</a><br />';
            }
      $return .= 
          '</td>'.
        '</tr>'.
      '</table>'.
      '<br /><br />'.
      '<table cellpadding="0" cellspacing="0" border="0">'.
        '<tr>'.
          '<td align="left" width="180">';
            if (($num-25) >= 0){
              $return .=
              '<a class="link" href="/archive/fibonacci/'.($num-25).'/">previous 25 fibonacci numbers</a>';
            }
          $return .=
          '</td>'.
          '<td align="right" width="180">';
            if (($num+25) <= $count){
              $return .=
              '<a class="link" href="/archive/fibonacci/'.($num+25).'/">next 25 fibonacci numbers</a>';
            }
          $return .=
          '</td>'.
        '</tr>'.
      '</table>';
    }else{
      $return .= 
      'We can\'t find the '.numbers::stndrd($num).' fibonacci number in our database.';
    }

    $return .= 
    '<br /><br /><br />'.
    '<form action="" method="get" target="_top">Display the <input name="num" type="text" value="" /> fibonacci number <input type="submit" value="Go" /><input type="hidden" name="page" value="archive/fibonacci" />
    </form>'.
    '<br /><br /><br />'.
    '<a class="link" href="/archive/fibonacci/100/">100th Fibonacci Number</a><br />'.
    '<a class="link" href="/archive/fibonacci/1000/">1000th Fibonacci Number</a><br />'.
    '<a class="link" href="/archive/fibonacci/10000/">10000th Fibonacci Number</a><br />'.
    '<a class="link" href="/archive/fibonacci/'.$count.'/">Our Biggest Fibonacci Number</a><br />';

    return $return;
  }
}
