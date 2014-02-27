<?php
die();
$link = mysql_connect('192.168.0.22', 'root', '');
mysql_select_db("db");

function is_prime($n){
    //this function return true or false if a number is prime or not
    //this function assumes that the number is not even
    $sqrt = ceil(sqrt($n))+1;
    //check the serious way
    $j=2;
    if (bcmod($n,3) == 0){return FALSE;end;}
    for($i=5; $i<$sqrt; $i+=$j, $j=6-$j) {
        if (bcmod($n,$i) == 0)
            {return FALSE;end;}
    }
    //else it must be prime
    return TRUE;
}

//getting the last prime number entry from the database
$id = mysql_result(mysql_query("SELECT count(*) FROM prime_numbers") ,0);
$query = mysql_query("SELECT number FROM prime_numbers WHERE id=".$id);
$biggestprime = mysql_result($query,0);

if ($biggestprime > 0){
    
    $i = $biggestprime;
    for ($z=0; $z<100; $z++){
        $i += 2;
        while (is_prime($i) == false){
            $i += 2;
        }
        $prime_array[] = $i;
    }
    
    $query_primes = implode("),(",$prime_array);
    mysql_query("INSERT INTO prime_numbers (number) VALUES (".$query_primes.")",$link);
}
?>
