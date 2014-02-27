<?php
//REDUNDENT?!!!
//
//
//
//
//
//
//
//
/**
* Class for managing units.
*/
class unitManagment{
    /**
    * Retrives unit form database if there is any left doing.
    * @param string $unitType The type of unit that is being requested.
    * @return array|bool array of data that the unit needs or false if there are know units left to be processed.
    */
    public function re trieve Unit($unitType,&$resultId){
        global $database;
        $classId = $database->fetchRow('unitClasses',array('id'),"name='$unitType'");
        $c = $database->count('units',"unitClass=$classId AND done=0");
        echo $c,'*';
        if($c){
            $unit = $database->fetchRow('units',array('toBeSent','id','deadLine'),"done=0 AND unitClass=$classId",'id');
            $_SESSION['units'][$unit['id']]['start'] = time();
            $_SESSION['units'][$unit['id']]['deadLine'] = $unit['deadLine'];
            unset($unit['deadLine']);
            $classData = unserialize($unit['toBeSent']);
            $classData['unitId'] = $unit['id'];
            $classData = json_encode($classData);
            $database->insert(
                'unitResults',
                array(
                    'unitId',
                    'userIp',
                    'userAgent'
                ),
                array(
                    $unit['id'],
                    $_SERVER['REMOTE_ADDR'],
                    $_SERVER['HTTP_USER_AGENT']
                )
            );
            $resultId = $database->lastId;
            return $classData;
        }else{
            return false;
        }
    }
    /**
    * Sends the result of unit processing to database once completed.
    * @param int $unitId The id of the unit that has just been completed
    * @param string $result JSON string of the units resulting data.
    */
    public function sendUnit($unitId,$result,$resultId){
        global $database;
        $overDeadLine = $this->calcOverDeadline($unitId,&$start);
        $done=0;
        if(!$overDeadLine){
            $done=1;
        }
        echo $result,'<br />';
        $result = json_decode(stripslashes($result));
        print_r($result);echo '<br />';
        $result = serialize($result);
        echo $result;
        $config = $this->getConfig();
        $c = $database->count('unitResults',"unitId=$unitId AND done=1");
        if($c == $config['Unit Trys']-1){
            $database->update(array('done'=>1),'units',"id={$unitId}");
        }
        $database->update(
            array(
                'result'=>$result,
                'timestampReceived'=>date("Y-m-d H:i:s"),
                'done'=>$done
            ),
            'unitResults',
            "id=$resultId"
        );

    }
    /**
    * Gets config data.
    * @return array array of config data.
    */
    public function getConfig(){
        global $database;
        $rows = $database->fetchRows('config','*');
        foreach($rows as $row){
            $config[$row['name']] = $row['value'];
        }
        return $config;
    }
    /**
    * Checks to see if unit has passed it deadline
    * @param int $id Id of the unit that is to be checked
    * @param int $start set the given varible to the time the unit started.
    * @return boolean True if the unit is pasted it deadline false if not.
    */
    private function calcOverDeadline($id){
        $start = $_SESSION['units'][$id]['start'];
        $deadLineEx = explode(' ',strtolower($_SESSION[$id]['deadLine']));
        if($deadLineEx[1]=='sec'){
            $deadline = $_SESSION[$id]['start'] + (60 * $deadLineEx[0]);
        }elseif($deadLineEx[1]=='min'){
            $deadline = $_SESSION[$id]['start'] + (60 * 60 * $deadLineEx[0]);
        }elseif($deadLineEx[1]=='day'){
            $deadline = $_SESSION[$id]['start'] + (24 * 60 * 60 * $deadLineEx[0]);
        }elseif($deadLineEx[1]=='week'){
            $deadline = $_SESSION[$id]['start'] + (7 * 24 * 60 * 60 * $deadLineEx[0]);
        }elseif($deadLineEx[1]=='month'){
            $deadline = $_SESSION[$id]['start'] + (30 * 24 * 60 * 60 * $deadLineEx[0]);
        }elseif($deadLineEx[1]=='year'){
            $deadline = $_SESSION[$id]['start'] + (364 * 24 * 60 * 60 * $deadLineEx[0]);
        }
        unset($_SESSION['units'][$id]);
        $finish = time();
        if($deadline > $finish){
            return true;
        }else{
            return false;
        }
    }
}
?>
