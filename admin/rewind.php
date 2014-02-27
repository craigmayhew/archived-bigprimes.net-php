<?php
//this file will revert the database back to an earlier version
//this is to be used when the database had been damaged or malformed data has gone in
//you revert back to a chosen prime number WIPING OUT ALL RECENT DATA
/*
//get data from url arguement
$rewindToPrime = $_REQUEST['rewindToPrime'];

//fail safe
if($rewindToPrime < 1400000000){die('error 1');}

require_once('../classes/database.php');
require_once('../config/site.config.php');
//connect to database
$database = new database($config['db']['host'],$config['db']['user'],$config['db']['pass'],'bigprime_grid');

//delete all work units
mysql_query('DELETE * FROM `unitResults`');
mysql_query('DELETE * FROM `units`');
mysql_query('DELETE * FROM `unitsAll`');
//reset prime database
    //delete rows
    mysql_query('DELETE FROM `prime_numbers2` WHERE `n` > '.$rewindToPrime);
    //reset autoinc value
    //check to make sure the biggest id in the database is the same as the number of rows
    $primeCount = $database->count('prime_numbers2');
    if(false > $primeCount){
        die('error 2');
    }
    mysql_query('ALTER TABLE `prime_numbers2` AUTO_INCREMENT = '.($primeCount+1));
//reset both background scripts

//generate new work units
//TODO: ASK TOM as the generateUnits.php file appears to start from zero
$unitManagment = new unitManagment();
$numbers = 1000000000000;
$noPerUnit = 20000;
$y=0;
//TODO this should not be one - this should be one larger than the largest prime number in the database
for($i=1;$i<$numbers;$i+=$noPerUnit){
    $unit = array();
    $unit['start'] = $i;
    $unit['end'] = $i+$noPerUnit-1;
    $unit = serialize($unit);
    $units[] = array(1,$unit,'1 hour');
    echo $i,'<br />';
    if($y==50){
        $y=-1;
        $database->insert(
            'unitsAll',
            array('unitClass','toBeSent','deadLine'),
            $units
        );
        $units=array();
    }
    $y++;
}*/
?>