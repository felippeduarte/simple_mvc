<?php
function autoloader($class)
{
    $filename = dirname(__FILE__) . '/' . str_replace('\\', '/', $class) . '.php';
    include($filename);
}
spl_autoload_register('autoloader');