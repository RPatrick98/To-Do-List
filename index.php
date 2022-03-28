<?php

require('resources/header.php');

include("resources/functions.php");

$lists = getAllLists();

$tasks = getAllTasks();

$statusOptions = getAllStatus();








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
            <form method="POST">
                <div>  
                    <input type="hidden" id="<?=$list["id"]?>" name="id" value="<?=$list["id"]?>">
                    <input name="editName" id="editName" type="text">
                    <button type="submit">Edit name</button>
                </div>
            </form>
                
            <a href="index.php?id=<?=$list["id"]?>">Delete</a>
            

            <?php 

            
            foreach($tasks as $task) {
                if($list["id"] == $task["list_id"]) {
                   
            ?>

            

            <div class="task-div">
                <div class="desc-task">
                    <p><?=$task["task_description"]?></p>
                </div>
                
                <div class="edit-task">
                   <a href="editTask.php?id=<?=$task["id"]?>">Edit Task</a>
                </div>
               
                <div class="delete-task">
                    <form method="POST">
                        <input type="hidden" id="<?=$task["list_id"]?>" name="taskID" value="<?=$task["id"]?>">
                        <button>delete task</button>
                    </form>
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
                        <input name="time" type="number">
                        <select name="taskStatus" id="taskStatus">

                            <?php
                            foreach ($statusOptions as $statusOption) {
                            ?>
                            <option value="<?=$statusOption["name"]?>"><?=$statusOption["name"]?></option>
                            <?php
                            }
                            ?>


                        </select>
                        <button type="submit" id="add-btn">Add new task</button>
                    </div>
                </form>
            </div>



            
        </div>

        
        <?php
        }
        
        


        ?>
        <form method="POST">
            <div>
                <label for="nameList">Add new list</label>
                <input name="nameList" id="nameList" type="text">
                <button type="submit" id="">Add</button>
            </div>
        </form>
        
    </div>


    <?php require('resources/footer.php'); ?>