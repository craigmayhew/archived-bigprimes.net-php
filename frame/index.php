<?php
date_default_timezone_set('Europe/London');
ini_set('memory_limit','1G');

require_once('autoLoader.php');

require '../vendor/autoload.php';

/*simple error handler*/
function errorBT(){
  echo array_walk(debug_backtrace(),create_function('$a,$b','print "{$a[\'function\']}()(".basename($a[\'file\']).":{$a[\'line\']}); ";'));
}
//$old_error_handler = set_error_handler("errorBT");

/*action / page logic*/
if(isset($_GET['page'])){
  $pageName = $_GET['page'];
  $pageName = 'pages\\'.str_replace('/','\\',preg_replace("#[^a-zA-Z0-9/]+#", "", $pageName));
  $vars = explode('/',isset($_GET['vars'])?$_GET['vars']:false);
  
  if(!file_exists($className = '../site/classes/'.str_replace('\\', '/', $pageName).'.php')){
    $header = new \includes\header(new \pages\home());
    header('HTTP/1.0 404 Not Found');
    echo $header->getContent();
    $e404 = new \errors\e404();
    echo $e404->getContent();
  }else{
    $page = new $pageName($vars);
    $header = new \includes\header($page);
    echo $header->getContent();
    if($page->authenticated()){
      echo $page->getContent();
    }else{
      echo '<h1>Access Denied</h1><br />Please <a href="/account/login/"><u>login</u></a> to view this page.';
    }
  }

  echo \includes\footer::getContent();
}elseif(isset($_GET['action'])){
  $actionName = $_GET['action'];
  $actionName = 'actions\\'.str_replace('/','\\',preg_replace("#[^a-zA-Z0-9/]+#", "", $actionName));
  $vars = explode('/',isset($_GET['vars'])?$_GET['vars']:false);

  $action = new $actionName($vars);
  if($action->authenticated()){
    echo $action->getContent();
  }
}elseif(isset($_GET['raw'])){
  $rawName = $_GET['raw'];
  $rawName = 'raw\\'.str_replace('/','\\',preg_replace("#[^a-zA-Z0-9/]+#", "", $rawName));
  $vars = explode('/',isset($_GET['vars'])?$_GET['vars']:false);
  
  $raw = new $rawName($vars);
  if($raw->authenticated()){
    echo $raw->getContent();
  }
}
