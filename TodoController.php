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
}
