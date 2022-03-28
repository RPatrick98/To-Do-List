<?php

include("resources/functions.php");

require('resources/header.php');

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


?>

<div class="editpage-div">
    <p>Task description</p>
    <form method="POST">
        <textarea name="updateContentTask" id="contentTask" cols="30" rows="2"><?=$oneTask[0]["task_description"]?></textarea>
        <label for="updateTime">Duration</label>
        <input id="time" name="updateTime" type="number" value="<?=$oneTask[0]["task_time"]?>">
        <select name="updateTaskStatus" id="taskStatus">
        <?php
            foreach ($statusOptions as $statusOption) {
        ?>
            <option value="<?=$statusOption["name"]?>" <?php if($oneTask[0]["task_status"] == $statusOption["name"]) { echo "selected"; } ?>><?=$statusOption["name"]?></option>
        <?php
         }
        ?>
        </select>
        <button class="button" type="submit">Update task</button>
    </form>
</div>




<?php require('resources/footer.php'); ?>