<?php

include("resources/functions.php");

$lists = getAllLists();

$tasks = getAllTasks();








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
            "contentTask" => $_POST["contentTask"]
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
    header("location: index.php");
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

  

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
                <p><?=$task["task_description"]?></p>
                <button>edit task</button>
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
                        <label for="contentTask">Task name</label>
                        <input name="contentTask" id="contentTask" type="text">
                        <button type="submit">Add new task</button>
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
                <button type="submit">Add</button>
            </div>
        </form>
        
    </div>
























     <!-- <div class="main-div">
        

        <?php
    
            $allTabes = getAllTabes();
            
        foreach($allTabes as $allTabe) {
        
        ?>
        <div class="list-div">

            <?php 
            
            
            ?>
            <h2><?=$allTabe["list_name"]?></h2>
            <form method="POST">
                <div>  
                    <input type="hidden" id="<?//=$list["id"]?>" name="id" value="<?//=$list["id"]?>">
                    <input name="editName" id="editName" type="text">
                    <button type="submit">Edit name</button>
                </div>
            </form>
                
            <a href="index.php?id=<?//=$list["id"]?>">Delete</a>
            
            <div class="task-div">

            

         
                <p><?=$allTabe["task_description"]?></p>
          
               
            </div>


            <div class="create-task">
            <form method="POST">
                    <div>
                        <input type="hidden" id="<?//=$list["id"]?>" name="idList" value="<?//=$list["id"]?>">
                        <label for="contentTask">Task name</label>
                        <input name="contentTask" id="contentTask" type="text">
                        <button type="submit">Add new task</button>
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
                <button type="submit">Add</button>
            </div>
        </form>
        
    </div>
    
    
 
    
</body>
</html>  -->