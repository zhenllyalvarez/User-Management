<?php
namespace user_management\App\Database;


use PDO;
use PDOException;

class Database
{
    private $host;
    private $user;
    private $password;
    private $database;
    private $connection;
    private $status;

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->database = "user_management";
        $this->status = false;
        $this->connection = $this->Initialize();
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {
        return $this->connection = null;
    }

    public function Initialize()
    {
        try {
            $conn = new PDO("mysql:host=$this->host", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->exec("CREATE DATABASE IF NOT EXISTS {$this->database}");

            $conn = new PDO("mysql:host=$this->host;dbname={$this->database}", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->status = true;
            return $conn;
        } catch (PDOException $e) {
            return "Error Database" . $e->getMessage();
        }
    }

    public function executeSQLFile($sqlFile)
    {
        try {
            if (!file_exists($sqlFile)) {
                die("SQL file not found: $sqlFile");
            }

            $sql = file_get_contents($sqlFile);
            $this->connection->exec($sql);
            echo "SQL file executed successfully.";
        } catch (PDOException $e) {
            return "Error execute" . $e->getMessage();
        }
    }
}
