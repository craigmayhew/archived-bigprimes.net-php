<?php
function insert($string){
	$string = stripslashes($string);
	$string = strip_tags($string);
	$string = trim($string);
	$string = addslashes($string);
	return $string;
}

// add st nd rd th to a number
function stndrd($n)
{
    if ($n == 1)
        {return $n.'st';}
    elseif ($n == 2)
        {return $n.'nd';}
    elseif ($n == 3)
        {return $n.'rd';}
    elseif ($n == 11)
        {return $n.'th';}
    elseif ($n == 12)
        {return $n.'th';}
    elseif ($n == 13)
        {return $n.'th';}
    elseif (substr($n,(strlen($n)-1),1) == '1')
        {return $n.'st';}
    elseif (substr($n,(strlen($n)-1),1) == '2')
        {return $n.'nd';}
    elseif (substr($n,(strlen($n)-1),1) == '3')
        {return $n.'rd';}
    else
        {return $n.'th';}
}
?>