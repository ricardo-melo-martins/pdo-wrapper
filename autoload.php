<?php

define('RMM_VERSION', '0.0.1');

$classmap = [
    'RMM' => __DIR__ . '/src/',
];

spl_autoload_register(function(string $classname) use ($classmap) 
{
    $parts = explode('\\', $classname);

    $namespace = array_shift($parts);
    $classfile = array_pop($parts) . '.php';

    if (! array_key_exists($namespace, $classmap)) {
        return;
    }

    $path = implode(DIRECTORY_SEPARATOR, $parts);
    $file = $classmap[$namespace] . $path . DIRECTORY_SEPARATOR . $classfile;

    if (! file_exists($file) && ! class_exists($classname)) {
        return;
    }

    require_once $file;
});