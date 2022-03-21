<?php 

include("db.php");


// List Functions
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

// Task functions
function getAllTasks() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM tasks ORDER BY id");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

function createTask($data4) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("INSERT INTO tasks (task_description, list_id) 
		VALUES (:task_description, :list_id)");
	$query->bindParam(":task_description", $data4["contentTask"]);
	$query->bindParam(":list_id", $data4["idList"]);
	$query->execute();
}

function getCatTask($idListTasks) {
	$conn = openDatabaseConnection();

	$query = $conn->prepare("SELECT * FROM tasks WHERE list_id = :list_id");
	$query->bindParam(":list_id", $idListTasks);
	$query->execute();
	$result = $query->fetch();
	return $result;
}

// two tabels 

function getAllTabes() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT tasks.task_description, list.list_name, list.id
	FROM list
	INNER JOIN tasks ON tasks.list_id=list.id;");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}



function deleteTask($data5) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("DELETE FROM tasks WHERE id = :id");
	$query->bindParam(":id", $data5["taskID"]);
	$query->execute();
}

