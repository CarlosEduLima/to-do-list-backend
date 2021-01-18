<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/to-dos.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Todo($db);

    $stmt = $items->getTasks();
        $toDoArr = array();
        $toDoArr["body"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "task" => $task,
                "date" => $date,
                "priority" => $priority,
                "done" => $done
            );

            array_push($toDoArr["body"], $e);
        }
        echo json_encode($toDoArr);

?>