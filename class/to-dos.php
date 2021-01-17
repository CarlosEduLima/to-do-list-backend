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

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }


        // GET ALL
        public function getTasks(){
            $sqlQuery = "SELECT id, task, date, priority FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createTask(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        task = :task, 
                        date = :date, 
                        priority = :priority";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->task=htmlspecialchars(strip_tags($this->task));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->priority=htmlspecialchars(strip_tags($this->priority));
        
            // bind data
            $stmt->bindParam(":task", $this->task);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":priority", $this->priority);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        task, 
                        date, 
                        priority
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->task = $dataRow['task'];
            $this->date = $dataRow['date'];
            $this->priority = $dataRow['priority'];
        }        

        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        task = :task, 
                        date = :date, 
                        priority = :priority
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->task=htmlspecialchars(strip_tags($this->task));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->priority=htmlspecialchars(strip_tags($this->priority));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":task", $this->task);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":priority", $this->priority);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEmployee(){
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