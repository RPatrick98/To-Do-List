<?php

require('resources/header.php');

include("resources/functions.php");

$lists = getAllLists();

$tasks = getAllTasks();

$statusOptions = getAllStatus();

$timeLow = getTimeLow();
$timeHigh = getTimeHigh();








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
    } else if(isset($_POST['stuf'])) {
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





?>




  

    <div class="main-div">
        
        <?php
        foreach ($lists as $list) {
        ?>
        <div class="list-div">

            
            <h2><?=$list["list_name"]?></h2>
            <div class="edit-name"> 
                <form method="POST">
                    
                        <input type="hidden" id="<?=$list["id"]?>" name="id" value="<?=$list["id"]?>">
                        <input  placeholder="Edit name" name="editName" id="editName" type="text">
                        <button class="button" type="submit">Edit name</button>
                        <a href="index.php?id=<?=$list["id"]?>" class="del">Delete</a>
                    
                </form>
            </div>
           
                
            <div class="sort-time">
                <form method="POST">
                    <select name="stuff">
                        <option value="low">Decreasing time</option>
                        <option value="high">Increasing time</option>
                    </select>
                    <input type="submit" value="Sort">
                </form>
             </div>

             <div class="filter-status">
                <form method="POST">
                    <select name="status">
                        <option value="open">Open</option>
                        <option value="procces">In Procces</option>
                        <option value="closed">Closed</option>
                    </select>
                    <input type="submit" value="Filter">
                </form>
             </div>
            

            <?php 

            
            foreach($tasks as $task) {
                if($list["id"] == $task["list_id"]) {
                   
            ?>

            

            <div class="task-div">
                <div class="desc-task">
                    <p><?=$task["task_description"]?></p>
                </div>


                <div class="btn-task">
                    <div class="edit-task">
                    <a href="editTask.php?id=<?=$task["id"]?>" class="button">Edit</a>
                    </div>
                
                    <div class="delete-task">
                        <form method="POST">
                            <input type="hidden" id="<?=$task["list_id"]?>" name="taskID" value="<?=$task["id"]?>">
                            <button class="del">Delete</button>
                        </form>
                    </div>
                </div>
                
                
                
                
            </div>

            <?php
                }
            }
            ?>


            <div class="create-task">
            <form method="POST">
                    <div>
                        <input type="hidden" id="<?=$list["id"]?>" name="idList" value="<?=$list["id"]?>">
                        <textarea name="contentTask" placeholder="Add another card" id="contentTask" cols="30" rows="2"></textarea>
                        <label for="time">Duration</label>
                        <input id="time" name="time" type="number">
                        <select name="taskStatus" id="taskStatus">

                            <?php
                            foreach ($statusOptions as $statusOption) {
                            ?>
                            <option value="<?=$statusOption["name"]?>"><?=$statusOption["name"]?></option>
                            <?php
                            }
                            ?>


                        </select>
                        <button class="create" type="submit" id="add-btn">Add new task</button>
                    </div>
                </form>
            </div>



            
        </div>

        
        <?php
        }
        
        


        ?>

        <div class="new-list">
            <form method="POST">
                <div>
                    <label for="nameList">Add new list</label>
                    <input id="newtask" name="nameList" id="nameList" type="text">
                    <button class="create" type="submit" id="">Add</button>
                </div>
            </form>
        </div>
        
        
    </div>


    <?php require('resources/footer.php'); ?>