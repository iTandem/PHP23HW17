<?php
    require_once 'Autoloader.php';
    require_once './vendor/autoload.php';
    
    session_start();
    
    $config = include(__DIR__ . '/config.php');
    
    foreach ($config as $key => $value) {
        $$key = $value;
    }
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    
    $loader = new Twig_Loader_Filesystem('./views');
    $twig = new Twig_Environment($loader, array(
        'cache' => './tmp/cache',
        'auto_reload' => true,
    ));
    
    $factory = new ControllerFactory($pdo, $twig);
    $controller = $factory->createController($_SERVER['PHP_SELF']);
    
    
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 22.06.2018
     * Time: 18:57
     */