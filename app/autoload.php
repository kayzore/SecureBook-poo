<?php
spl_autoload_register(function ($classname){
    $file = __DIR__ . '/' . str_replace('app\\', '', $classname) . '.php';
    if (!file_exists($file)) {
        $file = '../src/' . str_replace('\\', '/', $classname) . '.php';
    }
    if (!file_exists($file)) {
        $file = '../vendor/' . str_replace('\\', '/', $classname) . '.php';
        var_dump($file);
    }
    include_once $file;
});