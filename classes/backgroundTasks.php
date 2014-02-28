<?php
class backgroundTasks{
    public $database;
    /**
    * Sets a back ground task to running/not running
    * 
    * @param string $task The name of the task that is running.
    * @param boolean $running Ture to set the task running and false to set the task not running. defaults to true.
    */
    public function setTaskRunning($task,$running=true){
        if($running==true){
            $running = 1;
        }else{
            $running = 0;
        }
        $this->database->update(array('running'=>$running),'backgroundTasks',"task='$task'");
    }
    /**
    * Checks to see if a task is running
    * 
    * @param string $task Name of task to check
    * @return bool True if task is running and false if the task is not running.
    */
    public function isRunning($task){
        $c = $this->database->count('backgroundTasks',"task='$task' AND running=1");
        if($c){
            return true;
        }else{
            return false;
        }
    }
}
?>
