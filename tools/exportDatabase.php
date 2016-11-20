<?php
ob_start("ob_gzhandler");
//load the config array
require_once('config/site.config.php');

//load the generic functions
require_once('functions/include_functions.php');
require_once('functions/generic.php');
require_once('includes.php');

require_once('header.php');

set_time_limit(360000);

$myFile = "1400000000-primes.txt";
$fh = fopen($myFile, 'a');

for($i=1;$i<=1400000000;$i++){
    $str = $primes->getPrime($i)."\n";
    fwrite($fh, $str);
}

fclose($fh);

require_once('footer.php');
?>
