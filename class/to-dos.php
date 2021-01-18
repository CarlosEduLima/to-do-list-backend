<?php
    class ToDo{

        // Connection
        private $conn;

        // Table
        private $db_table = "todos";

        // Columns
        public $id;
        public $task;
        public $date;
        public $priority;
        public $done;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }


        // GET ALL
        public function getTasks(){
            $sqlQuery = "SELECT id, task, date, priority, done FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createTask(){
            $sqlQuery = "INSERT INTO ". $this->db_table . " (task, date, priority)
             VALUES (:task, :date, :priority)";
        
            $stmt = $this->conn->prepare($sqlQuery);
            // bind data
            $stmt->bindParam(":task", $this->task);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":priority", $this->priority);
        
            if($stmt->execute()){
               return true;
            }
            return var_dump($stmt->errorInfo());
            
        }
        // DELETE
        function deleteTask(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>