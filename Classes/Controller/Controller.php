<?php
    
    namespace Controller;
    
    
    abstract class Controller
    {
        protected $pdo;
        protected $twig;
        
        public function __construct(\PDO $pdo, \Twig_Environment $twig)
        {
            $this->db = $pdo;
            $this->twig = $twig;
        }
        
    }
    
    
    
    
    
    
    
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 22.06.2018
     * Time: 18:28
     */