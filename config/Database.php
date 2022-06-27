<?php
    class Database {
        private $host = 'wcwimj6zu5aaddlj.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $dbname = 'y1y12yxrz3q0ak3k';
        private $username = 'vf6wblmltrr7g6gh';
        private $password = '';
        private $conn;

        public function connect() {
            $this->conn = null;
            try {
              $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
    }
}
