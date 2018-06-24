<?php
    
    spl_autoload_register(function ($classNameWithNamespace)
    {
        $pathToFile = __DIR__.'/Classes/'.str_replace('\\', DIRECTORY_SEPARATOR, $classNameWithNamespace).'.php';
        if (file_exists($pathToFile)) {
            require_once "$pathToFile";
        }
    }
    );

