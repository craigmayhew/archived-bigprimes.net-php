<?php
header("HTTP/1.0 404 Not Found");
set_include_path('../'.PATH_SEPARATOR.get_include_path());
require_once('config/site.config.php');

//load the generic functions
require_once('functions/include_functions.php');
require_once('functions/numbers.php');
require_once('functions/generic.php');
require_once('includes.php');
require_once('header.php');
?>
    <h1>404</h1>
    <h2>Oops! This page does not Exist</h2>
<?php require_once('footer.php');?>