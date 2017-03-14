<?php
spl_autoload_register(function ($classname){
    var_dump($classname);
    $file = __DIR__ . '/' . str_replace('app\\', '', $classname) . '.php';
    var_dump($file);
    if (!file_exists($file)) {
        $file = '../src/' . str_replace('\\', '/', $classname) . '.php';
        var_dump($file);
    }
    include_once $file;
});