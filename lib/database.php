<?php
class DB {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "farzan";
    private $conn;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->database}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $this->conn = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>