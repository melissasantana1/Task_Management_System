<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {  // só entra se tiver enviado o formulário
if (isset($_SESSION['role']) && isset($_SESSION['id'])){

    if  (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['assigned_to'])  && $_SESSION['role'] == 'admin' && isset($_POST['due_date'])){


	include "../DB_connection.php";

	 

function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$title = validate_input($_POST['title']);
	$description = validate_input($_POST['description']);
	$assigned_to = validate_input($_POST['assigned_to']);
	$id = validate_input($_POST['id']);
	$due_date = validate_input($_POST['due_date']);




	if (empty($title)){
	$em = "Title is required";
	  header("Location: ../edit_task.php?error=$em&id=$id");
	exit();

	}else if (empty($description)){
	 $em = "Description name is required";
	header("Location: ../edit_task.php?error=$em&id=$id");
	 exit();
	 }else if ($assigned_to == 0){
	 $em = "Select User";
	header("Location: ../edit_task.php?error=$em&id=$id");
	 exit();	
	} else {
        
   
   include "Model/Task.php";
   
   $data = array($title, $description, $assigned_to, $due_date, $id);
    update_task($conn, $data);

  $em = "Task updated successfully";
header("Location: ../edit-task.php?id=$id&success=" . urlencode($em));

exit();
     
	 

}
}else {
	$info = "Unknown error occured";
	header("Location: ../edit_task.php?error=$em");
	exit();
}


 }else{ 
  $em = "First login";
header("Location: ../login.php?error=$em");
exit();
}
}
