<?php
require '../includes.php';
foreach (scandir('functions') as $filename) {
    $path = dirname(__FILE__) . '/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}
