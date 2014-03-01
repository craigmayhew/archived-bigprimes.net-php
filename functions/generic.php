<?php
function getFileType($fileName){
    $fileNameEx = explode('.',$fileName);
    $fileType = $fileNameEx[count($fileNameEx)-1];
    return $fileType;
}
//Converts DD/MM/YYYY & DD/MM/YY format to timestamp
function date2timestamp($date,$seperator='/'){
    $dateEx = explode($seperator,$date);
    $date = (strlen($dateEx[2])==2?'20'.$dateEx[2]:$dateEx[2]).'-'.$dateEx[1].'-'.$dateEx[0].' 00:00:00';
    return $date;
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

function checkIllegalCharacters($string,$custom=''){
    $return = false;
    $IllegalCharacters = '!"£$%^&*()~#¬`\'\\/?<>|{}@~;:'.$custom;
    $c=strlen($string);
    for($i=0;$i<$c;$i++){
        if(stristr($IllegalCharacters,$string[$i])){
            $return = true;
            break;
        }
    }
    return $return;
}
function pr($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
//Add http:// to the front of a string if it is not already there.
function addHttp($string){
    if(substr($string,0,7) != 'http://' && substr($string,0,8) != 'https://'){
        return 'http://'.$string;
    }else{
        return $string;
    }
}
//Formats an php array into a javascript array
function formatJavasctiptArray($array){
    $string = '[';
    foreach($array as $k=>$v){
        $string .= "'$k':'$v',";
    }
    $string .=']';
    return $string;
}
//generats random string with numbers and lowercase letters
function generateString($length){
    $string = strtolower(substr(sha1(time()),0-$length));
    return $string;
}
function scrollableDiv($contents,$width,$height){
    echo '<div class="scrollablediv" style="width:',$width,'px;height:',$height,'px;">',$contents,'</div>';

}
function includer($aIncluder){
	$includeString = '';
	foreach($aIncluder as $k=>$include){
		if($include['type'] == 'css'){
			$includeString .= '<link href="'.$include['location'].'" rel="stylesheet" type="text/css">';	
		}elseif($include['type'] == 'js'){
			$includeString .= '<script language="javascript" src="'.$include['location'].'" type="text/javascript"></script>';
		}
	}
	return $includeString;

}
function displayError($error,$sizeOfBox = 200,$center = false){
    if($center == true){
        echo '<div align="center">';
    }
    if($error != ""){
        echo '<div class="errorbox" style="width:',$sizeOfBox,'px;">',$error,'</div>';
    }
    if($center == true){
        echo '</div>';
    }
}
function roundUp($int){
    if(stristr($int,".") == true){
        $exploded = explode(".",$int);
        if(strlen($exploded[1]) > 2){
            $exploded[1] = substr($exploded[1],0,2).".".substr($exploded[1],2)."<br>";
            $int = $exploded[0].".".ceil($exploded[1]);
        }
    }
    return $int;

}
//This returns the date ina readble format.
function formatDate($date,$seperater="/"){
    $date = substr($date,6).$seperater.substr($date,4,2).$seperater.substr($date,0,4);
	return $date;

}
//Adds elemelment to the beginning of array
function beginningArray($array,$element){
    $newArray[] = $element;
    foreach($array as $value){
        $newArray[] = $value;
    }
    return $newArray;
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
		$array = array(array(1,"January"),
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
					   array(12,"December"));
        if($all == true){
            $array = beginningArray($array,array(0,"All"));
        }
	}
    return $array;
}

/*This splits the keys of the array into its own array. and returns the keys and the values into 2 sepereate arrays. 
RETURNS:
$newArray[0] = An array of the keys of $array.
$newArray[1] = An Array of the values of $array.
*/
function keySplit($array){
	$aKeys = array_keys($array);
	$c = count($aKeys);
	for($i=0;$i<$c;$i++){
		$newArray[0][] = $aKeys[$i];
		$newArray[1][] = $array[$aKeys[$i]];
	}
	return $newArray;
}

//Adds the last value of the array to the beginning of the array.
function endToFront($array){
	$c = count($array);
	if($c > 1){
		for($i=1;$i<$c;$i++){
			$newArray[] = $array[$i];
		}
		$newArray[] = $array[0];
		return $newArray;
	}else{
		return false;
	}
}

//This function finds out if the column type is a string
function fieldTypeString($table,$name){
	$result = mysql_query("SELECT * FROM $table");
	$fields = mysql_num_fields($result);
	for($i=0;$i<$fields;$i++){
		if($name == mysql_field_name($result,$i)){
			$fieldType = mysql_field_type($result,$i);
		}
	}
	if($fieldType == "string") return true;
	elseif($fieldType == "blob") return true;
	elseif($fieldType == "int") return false;
}

//build_url(array("page"=>"world/city/place"))
function buildUrl($vars_in=false,$driver=0,$config){
	if($driver===0)
	{	$file = "index.php";
	}
	elseif($driver===2)
	{	$file = "raw.php";
	}
	else
	{	$file = "index.php";
	}
	if($vars_in==false) $vars_in = array();
		
	if(!isset($vars)) $vars=array();
	if(!is_array($vars)) $vars=array();
	$vars = array_merge($vars,$vars_in);
        $vars1 = '';
	foreach ($vars as $k=>$v)
	{	if($v!==null) $vars1 .= '&'.$k.'='.$v;
	}
	$vars = trim($vars1,"&");
	
	unset($vars1,$k,$v);	
	return "/$file?$vars";
}

//used to make invalid xml into valid xml .. e.g. sanitize data from database
function safeXML($str){
	$search = array('&','<','>',"'",'"','<br>');
	$replace = array('&amp;','&lt;','&gt;','&#39;','&quot;','<br />');
	$str = str_replace($search,$replace,$str);
	return $str;
}

?>
