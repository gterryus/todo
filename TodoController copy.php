<?php
namespace TodoController;

require_once '../vendor/autoload.php';
use OpenConnection\OpenConnection;

// Create a database connection
$dbConnection = new OpenConnection('localhost', 'root', '', 'todo');

class TodoController {
    private $dbConnection;
    private $data;

    public function __construct() {
        // Initialize a new instance of OpenConnection
        $this->dbConnection = new OpenConnection('localhost', 'root', '', 'todo');
    }
    
    public function index($passData) {
        $this->data['userdata'] = $passData['full_name'];
        
        //header("Location: todo-app.php");
        include "todo-app.php";
    }

    public function getData() {
        $jsonData = json_encode($this->data);
        $returnData = json_decode($jsonData);
        return $returnData;
    }
    
    // public function createTodo($passData) {
    //     var_dump($title);
    // }
}

/* Trigger a PHP Function */
// if (isset($_GET['action'])) {
//     $action = $_GET['action'];

//     $className = new TodoController();

//     if (method_exists($className, $action)) {
//         $passData = $_GET;
//         unset($passData['action']);

//         $className->$action($passData);
//     } else {
//         $err = "Invalid action method specified.";
//         header("Location: todo-app.php?err=" . urlencode($err));
//     }
// } else {
//     $err = "No action specified.";
//     header("Location: todo-app.php?err=" . urlencode($err));
// }

?>