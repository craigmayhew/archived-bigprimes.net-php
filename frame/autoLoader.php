<?php

//used to autoload classes
function myAutoload($name){
    $doNotInclude = false;
    if(file_exists($className = 'classes/'.str_replace('\\', '/', $name).'.php')){
    }elseif(file_exists($className = '../site/classes/'.str_replace('\\', '/', $name).'.php')){
    }else{
      require_once '../site/classes/errors/e404.php';
      $doNotInclude = true;
//      die('Missing class name'.$name);
    }
    if($doNotInclude == false){
      require_once $className;
    }
}
if(function_exists('spl_autoload_register')){
    spl_autoload_register('myAutoload');
}else{
    function __autoload($name){
        myAutoload($name);
    }
}
