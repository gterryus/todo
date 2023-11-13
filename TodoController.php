<?php
namespace TodoController;

require_once __DIR__ . '/vendor/autoload.php';
use OpenConnection\OpenConnection;

class TodoController {
    private $dbConnection;
    private $userdata;

    public function __construct() {
        // Initialize a new instance of OpenConnection
        $this->dbConnection = new OpenConnection('localhost', 'root', '', 'todo');
    }
    
    public function index() {
        $dataUser = $this->getUser();

        session_start();
        $_SESSION['datauser'] = $dataUser;

        header('Location: todo-app.php');
    }

    private function getUser() {
        $id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

        if (!$id) {
            return null;
        }
        
        $query = $this->dbConnection->getSpecificUser($id);

        try {
            $query->execute();
            $return = $query->fetch(\PDO::FETCH_ASSOC);
            return $return;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function getTodo() {
        $query = $this->dbConnection->getTodo();

        try {
            $query->execute();
            $return = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $return;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function delete($id){
        $conTodo = "WHERE id_todo = " . $id;
        $query = $this->dbConnection->dropTodo($conTodo);

        try {
            $query->execute();
            $message = "Delete row successfull!";
            header("Location: todo-app.php?message=" . urlencode($message));
            exit();
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    $className = new TodoController();

    if (method_exists($className, $action)) {
        $passData = $_GET;
        unset($passData['action']);

        $className->$action($passData);
    } else {
        $message = "Invalid action method specified.";
        header("Location: todo-app.php?message=" . urlencode($message));
    }
}

if (isset($_GET['delete'])) {
    $idToDelete  = $_GET['delete'];
    $className = new TodoController();
    $className->delete($idToDelete);
}