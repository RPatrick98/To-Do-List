<?php 


$statusOptions = getAllStatus();

$task_id = 0;
if(isset($_GET["id"])) {
    $task_id = $_GET["id"];
    
} 

$oneTask = getTask($task_id); 




if( $_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['updateContentTask'])) {
        $data7 = array(
            "updateContentTask" => $_POST["updateContentTask"],
            "updateTime" => $_POST["updateTime"],
            "updateTaskStatus" => $_POST["updateTaskStatus"],
            "id" => $_GET["id"]
        );
        
        updateTask($data7);
        header("location: index.php");
    }
}

$statusOptions = getAllStatus();

$task_id = 0;
if(isset($_GET["id"])) {
    $task_id = $_GET["id"];
    
} 

$oneTask = getTask($task_id); 




if( $_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['updateContentTask'])) {
        $data7 = array(
            "updateContentTask" => $_POST["updateContentTask"],
            "updateTime" => $_POST["updateTime"],
            "updateTaskStatus" => $_POST["updateTaskStatus"],
            "id" => $_GET["id"]
        );
        
        updateTask($data7);
        header("location: index.php");
    }
}