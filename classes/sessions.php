<?php
/**
 * A class for interacting with sessions
 */
class sessions{
    /**
    * $name Session name;
    * @var string
    */
    var $name = '';
    /**
    * Set Session Name
    * @return true
    */
    function __construct($sName='sessionName'){
        $this->name = $sName;
        session_name($sName);
    }
    /**
    * Start the session, check the browser signature has not changed
    * @return true
    */
    function start(){
        session_start();
        
        if (!isset($_SESSION['initiated'])){
            session_regenerate_id();
            $_SESSION['initiated'] = true;
        }
        if (isset($_SESSION['HTTP_USER_AGENT'])){
            if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])){
                /* Possibly prompt for password? */
                $this->destroy();
                exit;
            }
        }
        else{
            $_SESSION['HTTP_USER_AGENT'] = isset($_SERVER['HTTP_USER_AGENT'])?md5($_SERVER['HTTP_USER_AGENT']):md5('');
        }
        return true;
    }
    /**
    * Destroy the session
    * @return true
    */
    function destroy(){
        session_destroy();
    }
}
?>
