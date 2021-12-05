<?php

spl_autoload_register(function($className) {
    $classFile = PATH_ROOT . '/' . $className . '.php';
    $classFile = str_replace('\\', '/', $classFile);

    if (file_exists($classFile)) {
        require_once $classFile;
    }
});
