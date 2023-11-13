<?php
namespace OpenConnection;

class OpenConnection {
    protected $connection;
    private $host, $username, $password, $dbname;

    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        
        try {

            $this->connection = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            //echo "Connected!";

        } catch (\PDOException $e) {

            $err = "Connection Error! " . $e->getMessage();
            header("Location: index.php?err=" . urlencode($err));

            $this->connection = null;

        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function getUser($setUsername, $setPassword) {
        if ($this->connection instanceof \PDO) {
            $query = $this->connection->prepare("SELECT * FROM users WHERE username = '".$setUsername."' AND password = '". $setPassword ."'");
            return $query;
        }
    }

    public function getSpecificUser($id) {
        if ($this->connection instanceof \PDO) {
            $query = $this->connection->prepare("SELECT * FROM users WHERE user_id = " . $id);
            return $query;
        }
    }

    public function getTodo($conTodo = "") {
        if ($this->connection instanceof \PDO) {
            $query = $this->connection->prepare("SELECT * FROM todo " . $conTodo);
            return $query;
        }
    }

    public function dropTodo($conTodo = "") {
        if ($this->connection instanceof \PDO) {
            $query = $this->connection->prepare("DELETE FROM todo " . $conTodo);
            return $query;
        }
    }

    public function createTodo($conTodo = "") {
        if ($this->connection instanceof \PDO) {
            $query = $this->connection->prepare("INSERT INTO todo(title, create_date) " . $conTodo);
            return $query;
        }
    }
}