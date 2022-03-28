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
	$query = $conn->prepare("INSERT INTO tasks (task_description, list_id, task_time, task_status) 
		VALUES (:task_description, :list_id, :task_time, :task_status)");
	$query->bindParam(":task_description", $data4["contentTask"]);
	$query->bindParam(":list_id", $data4["idList"]);
	$query->bindParam(":task_time", $data4["time"]);
	$query->bindParam(":task_status", $data4["taskStatus"]);

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

function deleteListTasks($data2) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("DELETE FROM tasks WHERE list_id = :list_id");
	$query->bindParam(":list_id", $data2["id"]);
	$query->execute();
}


function updateTasks($data3) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("UPDATE tasks SET task_description = :task_description, task_time = :task_time, task_status = :task_status");
    $query->bindParam(":task_description", $data3["id"]);
	$query->bindParam(":task_time", $data3["id"]);
	$query->bindParam(":task_status", $data3["id"]);
	$query->execute();
}

function getTask($id) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
	$query->bindParam(":id", $id);
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

// status functions


function getAllStatus() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM selectstatus");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

function updateTask($data7) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("UPDATE tasks SET task_description = :task_description, task_time = :task_time, task_status = :task_status WHERE id = :id");
	$query->bindParam(":task_description", $data7["updateContentTask"]);
	$query->bindParam(":task_time", $data7["updateTime"]);
	$query->bindParam(":task_status", $data7["updateTaskStatus"]);
	$query->bindParam(":id", $data7["id"]);
	$query->execute();
}
