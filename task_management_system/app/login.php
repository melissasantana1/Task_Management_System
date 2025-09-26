<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {  // só entra se tiver enviado o formulário

    if (isset($_POST['user_name']) && isset($_POST['password'])){


	include "../DB_connection.php";

	 

function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$user_name = validate_input($_POST['user_name']);
	$password = validate_input($_POST['password']);

	if (empty($user_name)){
		$em = "user name is required";
	    header("Location: ../login.php?error=$em");
	    exit();
	}else if (empty($password)){
	 $em = "password name is required";
	 header("Location: ../login.php?error=$em");
	 exit();
	} else {


     $sql = "SELECT * FROM users WHERE username = ?"; 
     $stmt = $conn->prepare($sql);
     $stmt ->execute([$user_name]);

     if ($stmt -> rowCount() == 1) {
     	$user = $stmt ->fetch();
        $usernameDB = $user['username'];
        $passwordDB = $user['password'];
        $role = $user['role'];
        $id = $user['id'];


	        if ($user_name === $usernameDB && password_verify($password, $passwordDB)) {
        if ($role == "admin") {
            $_SESSION['role'] = $role;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $usernameDB;
            header("Location: ../index.php");
            exit();
      	} else if ($role == "employee") {
            $_SESSION['role'] = $role;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $usernameDB;
            header("Location: ../index.php");
            exit();
        }else {
      		$em = "incorrect username or password";
		    header("Location: ../login.php?error=$em");
		    exit();
      		
      	    }

      	 }else {
      	 $em = "incorrect username or password";
		 header("Location: ../login.php?error=$em");
		 exit();

         }

         }else {
      	$em = "incorrect username or password";
		header("Location: ../login.php?error=$em");
		exit();

         }

     }

	 

}
}else {
	$info = "First login";
	header("Location: ../login.php?info=" . urlencode($info));
	exit();
}

