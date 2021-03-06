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


// Een nieuwe lijst aanmaken
function createList($data) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("INSERT INTO list (list_name) 
		VALUES (:list_name)");
	$query->bindParam(":list_name", $data["nameList"]);
	$query->execute();
}


// Een lijst verdwijderen
function deleteList($data2) {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("DELETE FROM list WHERE id = :id");
	$query->bindParam(":id", $data2["id"]);
	$query->execute();
}


// Een naam van lijst veranderen 
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

// Een niuewe task aanmaken 
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


// Een task ophalen
function getCatTask($idListTasks) {
	$conn = openDatabaseConnection();

	$query = $conn->prepare("SELECT * FROM tasks WHERE list_id = :list_id");
	$query->bindParam(":list_id", $idListTasks);
	$query->execute();
	$result = $query->fetch();
	return $result;
}

// Aale tabels ophalen

function getAllTabes() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT tasks.task_description, list.list_name, list.id
	FROM list
	INNER JOIN tasks ON tasks.list_id=list.id;");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}



// Gekozen task verdwijderen
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

// time sort 

function getTimeHigh() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM tasks ORDER BY task_time ASC");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

function getTimeLow() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM tasks ORDER BY task_time DESC");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

// filter status

function getStatusOpen() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM tasks WHERE task_status = 'Open'");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

function getStatusProcces() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM tasks WHERE task_status = 'In Procces'");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

function getStatusClosed() {
	$conn = openDatabaseConnection();
	$query = $conn->prepare("SELECT * FROM tasks WHERE task_status = 'Closed'");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}






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












