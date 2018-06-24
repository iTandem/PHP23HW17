<?php
    
    namespace Controller;
    
    use \Model\User as User;
    
    class IndexController extends Controller
    {
        public function __construct($pdo, $twig)
        {
            parent::__construct($pdo, $twig);
            
            if ($_POST['login'] ?? '' && $_POST['pass'] ?? '') {
                
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                
                $user = new User($pdo);
                
                if ($_POST['action'] == 'Зарегистрироваться') {
                    $selectedUser = $user->findOneBy([
                        'login' => $login,
                    ]);
                    
                    if ($selectedUser) {
                        $errorMsg = "Пользователь с таким именем уже зарегистрирован";
                    }
                    else {
                        $user->add($login, $pass);
                    }
                } elseif ($_POST['action'] == 'Войти') {
                    $selectedUser = $user->findOneBy([
                        'login' => $login,
                        'password' => $pass
                    ]);
                    if($selectedUser) {
                        $_SESSION['user'] = $selectedUser['id'];
                        header('Location:manager.php');
                    } else {
                        $errorMsg = "Неверный логин или пароль";
                    }
                }
            }
            
            echo $twig->render('index.html.twig',[
                'login' => $_POST['login'] ?? '',
                'error' => nl2br($errorMsg ?? ''),
            ]);
        }
    }
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 22.06.2018
     * Time: 18:30
     */