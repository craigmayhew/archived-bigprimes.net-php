<?php

//used to make invalid xml into valid xml .. e.g. sanitize data from database
function safeXML($str){
  $search = array('&','<','>',"'",'"','<br>');
  $replace = array('&amp;','&lt;','&gt;','&#39;','&quot;','<br />');
  $str = str_replace($search,$replace,$str);
  return $str;
}
