<?php
//require all the classes
$dir = 'classes/';
if(is_dir($dir)) {
    
}elseif(is_dir('../classes/')){
    $dir = '../classes/';
}
if ($dh = opendir($dir)) {
    while (($file = readdir($dh)) !== false) {
        if($file != '.' && $file != '..' && !is_dir($dir.$file)){
            require_once($dir.$file);
        }
    }
    closedir($dh);
}
//Create database class instance
$database = new database(array('config'=>$config),$config['db']['host'],$config['db']['user'],$config['db']['pass'],$config['db']['db']);
if($database->connected){
    if(isset($c) && $c>0){
        $debug=true;
    }else{
        $debug=false;
    }
    //Config saved in database
    $errors = new errors(array('config'=>$config,'database'=>$database));
    //create some instances of classes
    $form = new form();
    $HTMLTags = new HTMLTags();
    $generic = new generic(array('database'=>$database));
    $url = new url(array('config'=>$config));
    $primes = new primes(array('database'=>$database));
    $backgroundTasks = new backgroundTasks();
    $classes = get_declared_classes();
    //Fixes slash problem with get and post vars.
    if(is_array($_REQUEST) && get_magic_quotes_gpc()){
        foreach($_REQUEST as $k=>$v){
            $_REQUEST[$k] = stripslashes($v);
        }
    }
    $rss = new rss(array('url'=>$url));
    $sumOfDigits = new sumOfDigits($primes,$database);
}
?>
