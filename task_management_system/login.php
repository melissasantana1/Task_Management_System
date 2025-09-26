<?php
session_start();

// Se não houver usuário logado → primeira visita
if (!isset($_SESSION['role'])) {
    $info = "First login";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Task Management System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
	
<form method="POST" action="app/login.php" class="shadow p-4">
	<h3 class="display-4">LOGIN</h3>

	<?php if (isset($info)) { ?>
		<div class="alert alert-info" role="alert">
			<?php echo htmlspecialchars($info); ?>
		</div>
	<?php } ?>

	<?php if (isset($_GET['error'])) { ?>
		<div class="alert alert-danger" role="alert">
			<?php echo htmlspecialchars($_GET['error']); ?>	
		</div>
	<?php } ?>

	<?php if (isset($_GET['success'])) { ?>
		<div class="alert alert-success" role="alert">
			<?php echo htmlspecialchars($_GET['success']); ?>	
		</div>
	<?php } ?>

	<div class="mb-3">
		<label class="form-label">User name</label>
		<input type="text" class="form-control" name="user_name">
	</div>
	<div class="mb-3">
		<label class="form-label">Password</label>
		<input type="password" class="form-control" name="password">
	</div>
	<button type="submit" class="btn btn-primary">Login</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
