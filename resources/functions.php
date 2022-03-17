<?php 

include("db.php");

function getAllLists() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM list");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}


function createList($data) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("INSERT INTO list (list_name) 
		VALUES (:list_name)");
	$query->bindParam(":list_name", $data["nameList"]);
	$query->execute();
}



function deleteList($data2) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("DELETE FROM list WHERE id = :id");
	$query->bindParam(":id", $data2["id"]);
	$query->execute();
}

function updateList($data3) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("UPDATE list SET list_name = :list_name WHERE id = :id");
    $query->bindParam(":id", $data3["id"]);
	$query->bindParam(":list_name", $data3["editName"]);
	$query->execute();
}