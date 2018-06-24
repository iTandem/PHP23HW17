<?php
    
    namespace Controller;
    
    use \Model\Task as Task;
    use \Model\User as User;
    
    class ManagerController extends Controller
    {
        public function __construct($pdo, $twig)
        {
            parent::__construct($pdo, $twig);
            
            if(!($_SESSION['user'] ?? '')) {
                http_response_code(403);
                echo 'Вход только для авторизованных пользователей!';
                exit;
            } else {
                
                $users = new User($pdo);
                $userId = $_SESSION['user'];
                $user = $users->find($userId);
                
                $descr = $_POST['description'] ?? '';
                $doneId = $_POST['done'] ?? '';
                $deleteId = $_POST['delete'] ?? '';
                $editId = $_POST['editId'] ?? '';
                $assignId = $_POST['assign'] ?? '';
                $assignedUserId = $_POST['assignedUser'] ?? '';
                
                $task = new Task($pdo);
                
                if($descr) {
                    if($editId) {
                        $task->updateTask($editId, $descr);
                    } else {
                        $task->insertTask($userId, $descr);
                    }
                }
                if($doneId) {
                    $task->completeTask($doneId);
                }
                if($deleteId) {
                    $task->deleteTask($deleteId);
                }
                if ($assignedUserId) {
                    $task->assignTask($assignId, $assignedUserId);
                }
                
                $columnOrder = $_POST['column'] ?? 'id asc';
                $myTasks = $task->findByUserOrderBy($userId, $columnOrder);
                $assignedTasks = $task->findByAssignedUserOrderBy($userId, $columnOrder);
                
                $editTask = ($_POST['edit'] ?? '') ? $task->findTask($_POST['edit']) : null;
                
                echo $this->twig->render('manager.html.twig',[
                    'tasks' => $myTasks,
                    'assignedTasks' => $assignedTasks,
                    'editTask' => $editTask,
                    'user' => $user,
                    'users' => $users->findAll(),
                ]);
            }
        }
        
    }
    
    
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 22.06.2018
     * Time: 18:33
     */