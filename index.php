<?php
ob_start("ob_gzhandler");
//load the config array
require_once('config/site.config.php');

//load the generic functions
require_once('functions/include_functions.php');
require_once('functions/numbers.php');
require_once('functions/generic.php');
require_once('includes.php');

//page stuff
$page = (isset($_REQUEST['page'])?$_REQUEST['page']:'');
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

    //login or logout
    if(isset($_POST['userEmail'])&&isset($_POST['userPass'])){
        $user = new user($_POST['userEmail'],$_POST['userPass']);
    }else{
        $user = new user(false,false);
    }
    $loginResult = $user->login();
    if(isset($_GET['logout']) == true){
        $user->logout();
    }
}
if(isset($_GET['page']) && isset($_GET['num'])){
    if($_GET['page'] == 'archive/prime' && $_GET['num']>($primes->maxPrime/100)){
        $page = '404';
    }
}
echo $loginResult;
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
?>