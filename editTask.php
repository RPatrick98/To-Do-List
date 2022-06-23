<?php

require('resources/header.php');


include("resources/functions.php");

include("resources/editTasksFunctions.php");









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