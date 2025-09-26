<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {  // só entra se tiver enviado o formulário
if (isset($_SESSION['role']) && isset($_SESSION['id'])){

    if  (
    	isset($_POST['id']) &&
    	 isset($_POST['status']) && $_SESSION['role'] == 'employee') {


	include "../DB_connection.php";

	 

function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


	$status = validate_input($_POST['status']);
	$id = validate_input($_POST['id']);
	$assigned_to = validate_input($_POST['assigned_to']);


 if (empty($status)){
        $em = "Status and Assigned To are required";
        header("Location: ../edit-task-employee.php?error=$em&id=$id");
        exit();

	} else {
        
   
   include "Model/Task.php";
   
   $data = array($status, $id);
    update_task_status($conn, $data);

  $em = "Task updated successfully";
header("Location: ../edit-task-employee.php?id=$id&success=" . urlencode($em));

exit();
     
	 

}
}else {
	$info = "Unknown error occured";
	header("Location: ../edit-task-employee.php?error=$em");
	exit();
}


 }else{ 
  $em = "First login";
header("Location: ../login.php?error=$em");
exit();
}
}
