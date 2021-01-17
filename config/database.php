<?php 
    class Database {
        private $host = "127.0.0.1";
        private $database_name = "to-do-api";
        private $user = "postgres";
        private $password = "postgres";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("pgql:host=" . $this->host . ";dbname=" . $this->database_name, $this->user, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>