<?php
/**
 * Generic Functions
 */
class generic{
	private $database;
	function __construct($classes){
		$this->database = $classes['database'];
	}
		/**
    * Get the name of a user from their id
    * @param int $userId User id
    * @return string The username
    */
    public function getName($userId){
        $name = $this->database->fetchRow('users',array('name'),"id='$userId'");
        return $name;
    }
}

?>
