<?php
//ob_start("ob_gzhandler");

require_once('includes.php');

//page stuff
$page = isset($_REQUEST['page'])?$_REQUEST['page']:'/';
$page = filter_var($page, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
$page = filter_var($page, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$page = preg_filter("/^[a-zA-Z0-9-\\/]+$/", '$0', $page);
if($database->connected){
    if ($page != ''){
        if (file_exists('pages/'.$page.'.php')){
            //yay the page exists!
        }elseif (file_exists('pages/'.$page.'/index.php')){
            //points to a folder rather than i file so we need to tell it to look for the index of that folder
            $page = $page.'/index';
        }else{
            unset($_GET['page']);
            $page = '404';
        }
    }else{
        unset($_GET['page']);
        $page = 'index';
    }
}
if(isset($_GET['page']) && isset($_GET['num'])){
    if($_GET['page'] == 'archive/prime' && $_GET['num']>($primes->maxPrime/100)){
        $page = '404';
    }
}

//Main site includes.
if($page=='404'){
    require_once('header.php');
    require_once('err/404.php');
    require_once('footer.php');
}elseif(!$database->connected){
    require_once('err/noDatabase.php');
}else{
    require_once('header.php');
    require_once('pages/'.$page.'.php');
    require_once('footer.php');
}
