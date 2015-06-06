<?php
namespace pages;

class status extends \pages{
  function getContent(){
    echo
    '<h1>Status</h1>
    <table cellpadding="3" cellspacing="0" border="1" class="text" bgcolor="#e0faed">
    <tr>
      <td width="200">Number of verified primes:</td>
      <td width="100">',$primes->maxPrime,'</td>
    </tr>
    <tr>
      <td>Raw storage used:</td>
      <td>',round(((($database->count('primeNumbers') * 100) * 8 / 1024) / 1024) / 1024,2),' GB</td>
    </tr>
    </table>';
  }
}
