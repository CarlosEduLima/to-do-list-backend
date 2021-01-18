<?php 
    class Database {
        private $host = "xxxx";
        private $port = 0000;
        private $database_name = "xxxx";
        private $user = "xxxx";
        private $password = "xxxx";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>