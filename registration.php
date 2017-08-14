<?php

include("admin/dbconfig.php");

$error_msg = "";
$success_msg = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$result = $user->register($_POST);
	if (isset($result['success'])) {
		$success_msg = $result['success'];
	} else {
		$error_msg = $result['error'];
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
	<?php 
		$title = "Registration";
		include "head_src.php";
	?>
	</head>

	<body>
	<?php include "header.php"; ?>
    <div id="maincontent" class="container">

		<?php if (!empty($error_msg)) { ?>
			<div id="error" class="alert alert-danger" role="alert">
				<?php echo $error_msg; ?>
			</div>
		<?php } ?>

		<?php if (!empty($success_msg)) { ?>
			<div id="success" class="alert alert-success" role="alert">
				<?php echo $success_msg; ?>
			</div>
		<?php } ?>

		<div class="row">
			<div class="col-md-4 col-md-offset-4 text-center">
				<a href="login.php" class="btn btn-link btn-lg btn-block">Login right now</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-4 text-center">
				<a href="signup.php" class="btn btn-link btn-lg btn-block">Register new user</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-4 text-center">
				<a href="index.php" class="btn btn-link btn-lg btn-block">Back to home page</a>
			</div>
		</div>
    </div>

    <?php include "footer.php"; ?>

	</body>
</html
