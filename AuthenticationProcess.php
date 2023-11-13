<?php
require_once __DIR__ . '/vendor/autoload.php';
use OpenConnection\OpenConnection;
use TodoController\TodoController;

session_start();

// Create a database connection
$dbConnection = new OpenConnection('localhost', 'root', '', 'todo');

if(isset($_POST['username']) && isset($_POST['password'])){
    $setUsername = $_POST['username'];
    $setPassword = $_POST['password'];

    $query = $dbConnection->getUser($setUsername, $setPassword);
    
    try {
        
        $query->execute();
        $user = $query->fetch(\PDO::FETCH_ASSOC);
        
        if ($user == true) {

            $_SESSION['login_user'] = $user['user_id'];

            $cookie_name = 'login_user';
            $cookie_value = $user['user_id'];
            $cookie_duration = strtotime("+1 days");
            setcookie($cookie_name, $cookie_value, $cookie_duration, "/");
            
            $todopage = new TodoController($dbConnection);
            $todopage->index();

        } else {
            $err = "Invalid username or password. Please try again.";
            header("Location: index.php?err=" . urlencode($err));
        }

    } catch (\PDOException $e) {

        $err = "Database error. Please try again later.";
        header("Location: index.php?err=" . urlencode($err));

    }
}
