<?php
    
    use \Controller\Index;
    
    class ControllerFactory
    {
        private $pdo;
        private $twig;
        
        public function __construct(\PDO $pdo, \Twig_Environment $twig)
        {
            $this->pdo = $pdo;
            $this->twig = $twig;
        }
        
        public function createController($file)
        {
            $viewName = pathinfo($file)['filename'];
            
            $controllerName = "\Controller\\".ucfirst($viewName).'Controller';
            
            return new $controllerName($this->pdo, $this->twig);
        }
    }
    
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 22.06.2018
     * Time: 18:24
     */