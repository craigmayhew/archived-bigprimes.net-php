<?php
//This returns an array of months
function months($all = false,$numeric = true){
    if($numeric){
        $array = array(1,2,3,4,5,6,7,8,9,10,11,12);
        if($all == true){
            $array = beginningArray($array,"All");
        }
    }else{   
        $array = array(
                    array(1,"January"),
                    array(2,"February"),
                    array(3,"March"),
                    array(4,"April"),
                    array(5,"May"),
                    array(6,"June"),
                    array(7,"July"),
                    array(8,"August"),
                    array(9,"September"),
                    array(10,"October"),
                    array(11,"November"),
		    array(12,"December")
	         );
        if($all == true){
            $array = beginningArray($array,array(0,"All"));
        }
    }
    return $array;
}

//used to make invalid xml into valid xml .. e.g. sanitize data from database
function safeXML($str){
  $search = array('&','<','>',"'",'"','<br>');
  $replace = array('&amp;','&lt;','&gt;','&#39;','&quot;','<br />');
  $str = str_replace($search,$replace,$str);
  return $str;
}
