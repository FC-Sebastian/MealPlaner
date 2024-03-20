<?php

function autoload($class) {
    $path = __DIR__.'/Application/'.str_replace('\\','/',$class).'.php';

    if (file_exists($path)) {
        require_once $path;
        return;
    }

    throw new Exception("Class ".$class." not found!");
}

spl_autoload_register('autoload');