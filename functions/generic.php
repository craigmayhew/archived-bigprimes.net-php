<?php
function getFileType($fileName){
    $fileNameEx = explode('.',$fileName);
    $fileType = $fileNameEx[count($fileNameEx)-1];
    return $fileType;
}
//Returns the key for a value in an array.
function getKey($arr,$value){
    foreach($arr as $k=>$v){
        if($v==$value){
            return $k;
        }
    }
}
//Returns all files in a directoy as an arrauy
function filesInDir($dir,$fileExtention='all'){
    $dh = opendir($dir);
    if(!$dh){
        mkdir($dir);
        $dh = opendir($dir);
    }
    if($dh){
        while($file = readdir($dh)){
            if($fileExtention!='all' && substr($file,-strlen($fileExtention))==$fileExtention){
                $files[] = str_replace($fileExtention,'',$file);
            }
        }
        return $files;
    }else{
        return array();
    }
}

//This returns an array of numbers from 1 to 31
function days($all = false){
    $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
    if($all == true){
        $array = beginningArray($array,"All");
    }
    return $array;
}
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
