<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin"){
   


$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<h4 class="title">Add Users <a href="user.php">Users</a></h4>
           
        <form class="form-1" method="POST" action="app/add-user.php">
         <?php if (isset($info)) { ?>
        <div class="info" role="alert">
            <?php echo htmlspecialchars($info); ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['error'])) { ?>
        <div class="danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?> 
        </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <div class="success" role="alert">
            <?php echo htmlspecialchars($_GET['success']); ?>   
        </div>
    <?php } ?>

            <div class="input-holder">
                <label>Full Name</label>
                <input type="text" name="full_name"class="input-1" placeholder="Full Name"><br><br>
            </div>

             <div class="input-holder">
                <label>Username</label>
                <input type="text" name="user_name"class="input-1" placeholder="Username"><br><br>
            </div>

             <div class="input-holder">
                <label>Password</label>
                <input type="text" name="password"class="input-1" placeholder="Password"><br><br>
            </div>

            <button class="edit-btn">Add</button>
        </form>
            
		</section>
	</div>


	<script type="text/javascript">
		var active = document.querySelector("#navList li:nth-child(2)");
		active.classList.add("active");
	</script>

</body>
</html>

<?php
 }else{ 
  $em = "First login";
header("Location: login.php?info=" . urlencode($em));
exit();
}
?>