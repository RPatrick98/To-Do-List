<?php

include("resources/functions.php");

$lists = getAllLists();




if( $_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['nameList'])) {
        $data = array(
            "nameList" => $_POST["nameList"]
        );
        createList($data);
        header("location: index.php");
    } else {
        $data3 = array(
            "id" => $_GET["id"],
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
                    <input name="editName" id="editName" type="text">
                    <button type="submit">Edit name</button>
                </div>
            </form>
                
            <a href="index.php?id=<?=$list["id"]?>">Delete</a>
        </div>
        <?php
        }
        ?>
        <form method="POST">
            <div>
                <input name="nameList" id="nameList" type="text">
                <button type="submit">Add</button>
            </div>
        </form>
        
    </div>
    
</body>
</html>