<?php
/**
 * Generic Functions
 */
class generic{
    /**
    * Get the name of a user from their id
    * @param int $userId User id
    * @return string The username
    */
    public function getName($userId){
        global $database;
        $name = $database->fetchRow('users',array('name'),"id='$userId'");
        return $name;
    }
}

?>