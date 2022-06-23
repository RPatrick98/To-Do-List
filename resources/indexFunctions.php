<?php


// hier worden functies aangeroepen om bepaalde dingen van db op te halen
$lists = getAllLists();

$tasks = getAllTasks();

$statusOptions = getAllStatus();

$timeLow = getTimeLow();
$timeHigh = getTimeHigh();







// hier worden verstuurde dingen met POST gecheckt en ingezet aan goeie array
if( $_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['nameList'])) {
        $data = array(
            "nameList" => $_POST["nameList"]
        );
        
        createList($data);
        header("location: index.php");
    } else if(isset($_POST['contentTask'])) {
        $data4 = array(
            "idList" => $_POST["idList"],
            "contentTask" => $_POST["contentTask"],
            "time" => $_POST["time"],
            "taskStatus" => $_POST["taskStatus"]


        );
        createTask($data4);
        header("location: index.php");
    } else if(isset($_POST['taskID'])) {
        $data5 = array(
            "taskID" => $_POST["taskID"]
        );
        deleteTask($data5);
        header("location: index.php");
    } else if(isset($_POST['stuff'])) {
        if ($_POST['stuff'] === 'low')  {
            $tasks = getTimeLow();
        } else if ($_POST['stuff'] === 'high') {
            $tasks = getTimeHigh();
        }
    }
    
    else if(isset($_POST['status'])) {
        if ($_POST['status'] === 'open') {
            $tasks = getStatusOpen();
        } else if ($_POST['status'] === 'procces') {
            $tasks = getStatusProcces();
        } else if ($_POST['status'] === 'closed') {
            $tasks = getStatusClosed() ;
        }
    }

    
    
    
    else {
        $data3 = array(
            "id" => $_POST["id"],
            "editName" => $_POST["editName"]
        );
        updateList($data3);
        header("location: index.php");
        
    } 


    

    
}


if(isset($_GET["id"])) {
    $data2 = array(
        "id" => $_GET["id"]
    );
    deleteList($data2);
    deleteListTasks($data2);
    header("location: index.php");
}


