<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {  // só entra se tiver enviado o formulário
if (isset($_SESSION['role']) && isset($_SESSION['id'])){

    if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name'])  && $_SESSION['role'] == 'admin'){


	include "../DB_connection.php";

	 

function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$user_name = validate_input($_POST['user_name']);
	$password = validate_input($_POST['password']);
	$full_name = validate_input($_POST['full_name']);


	if (empty($user_name)){
	$em = "user name is required";
	  header("Location: ../add-user.php?error=" . urlencode($em));
	exit();

	}else if (empty($password)){
	 $em = "password name is required";
	header("Location: ../add-user.php?error=" . urlencode($em));
	 exit();

	
	}else if (empty($full_name)){
	 $em = "Full name is required";
	 header("Location: ../add-user.php?error=" . urlencode($em));
	 exit();


	} else {
        

    
    include "Model/user.php";
    $password = password_hash($password, PASSWORD_DEFAULT);
    $data = array($full_name, $user_name, $password, "employee");
    insert_user($conn, $data);

    $em = "User created successfully";
	 header("Location: ../add-user.php?success=" . urlencode($em));
	 exit();
     
	 

}
}else {
	$info = "First login";
	header("Location: ../add-user.php?info=" . urlencode($info));
	exit();
}


 }else{ 
  $em = "First login";
header("Location: ../add-user.php?info=" . urlencode($em));
exit();
}
}
