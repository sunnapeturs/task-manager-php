<?php
/// CONNECT TO DATABASE
function connect(){

    $credentials = [
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'task_manager',
        'port' => 3306,
        ];

    // CREATE CONNECTION
    $connection = new mysqli(
        $credentials['servername'],
        $credentials['username'],
        $credentials['password'],
        $credentials['database'],
        $credentials['port']
        );

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
return $connection;
}

///CREATE TASK - INSERT DATA
function create_tasks($task){
    
    $connection = connect();
    //bæta við if statement til að validatea ef það vantar efni
    $title = $task['task_title'];
    $description = $task['task_description'];
    $priority = $task['priority'];
    $due_date = $task['due_date'];

    $sql = "INSERT INTO tasks (title, task_description, priority, due_date)
    VALUES ('$title','$description',$priority,'$due_date')";
if (isset($_POST['submit']))
    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

/// GET ALL TASKS
function get_all_tasks(){
    $connection = connect();

    $sql = "SELECT * FROM tasks";
    $result = $connection->query($sql);

    $tasks = [];

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            array_push($tasks, $row);
        }
    } else {
        echo "0 results";
    }
    return $tasks;
}

/// DELETE TASK
function delete_task($id){
    $connection = connect();

    $sql = "DELETE FROM tasks WHERE id=$id";
   
    if ($connection->query($sql) === TRUE) {
        echo "deleted successfully";
    } else {
        die("Error deleting record: " . $connection->error);
    }
    $connection->close();
    }

///UPDATE TITLE FIELD TASK
function update_task($task){
    $connection = connect();
    
    $sql = "UPDATE tasks SET title='Vaska upp' WHERE id=3";

    if ($connection->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connection->error;
    }  
    $connection->close();
}
///UPDATE ALL FIELDS TASK
function update_task_all($task){
    $connection = connect();

    $task_title = $task['title'];
    $description = $task['description'];
    $priority = $task['priority'];
    $due_date = $task['due_date'];
    $id = $task['id'];
    var_dump($task);
    
    $sql = "UPDATE tasks SET title='$task_title', task_description='$description', priority=$priority, due_date='$due_date' WHERE id=$id";
    echo $sql;
    if ($connection->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
         die("Error updating record: " . $connection->error);
    }  
    $connection->close();
}
//// GET ONE TASKS
function select_id($id){
    $connection = connect();

    $sql = "SELECT * FROM tasks WHERE id=$id";
    $result = $connection->query($sql);
   

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        die("0 results");
    }
}

    

?>
