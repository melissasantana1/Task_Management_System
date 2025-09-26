<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {  
if (isset($_SESSION['role']) && isset($_SESSION['id'])){

    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['assigned_to']) && $_SESSION['role'] == 'admin' && isset($_POST['due_date'])) {



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
	$due_date = validate_input($_POST['due_date']);



	if (empty($title)){
	$em = "Title is required";
	  header("Location: ../create_task.php?error=$em");
	exit();

	}else if (empty($description)){
	 $em = "Description name is required";
	header("Location: ../create_task.php?error=$em");
	 exit();
	 }else if ($assigned_to == 0){
	 $em = "Select User";
	header("Location: ../create_task.php?error=$em");
	 exit();	
	} else {
        
   
   include "Model/Task.php";
   include "Model/Notification.php";

   
   $data = array($title, $description, $assigned_to, $due_date);
    insert_task($conn, $data);

    $notif_data = [
                    'message'   => "'$title' has been assigned to you. Please review and start working on it.",
                    'recipient' => (int)$assigned_to,
                    'type'      => 'task',
                    'date'      => date("Y-m-d"), // formato correto para DATE no MySQL
                    'is_read'   => 0
                ];
    insert_notification($conn, $notif_data);


   $em = "Task created successfully";
	header("Location: ../create_task.php?success=" . urlencode($em));
	exit();
     
	 

}
}else {
	$info = "First login";
	header("Location: ../create_task.php?info=" . urlencode($info));
	exit();
}


 }else{ 
  $em = "First login";
header("Location: ../create_task.php?info=" . urlencode($em));
exit();
      }
}

