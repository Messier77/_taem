<?php 

include "./includes/admin_header.php";

session_start();

error_reporting(0);

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysqli_query($connection, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: index");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

	<!-- <link rel="stylesheet" type="text/css" href="./css/login.css"> -->

	<title>Trial and Error Makers - Login</title>

	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="login_f/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="login_f/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="login_f/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="login_f/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="login_f/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="login_f/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="login_f/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="login_f/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="login_f/css/util.css">
	<link rel="stylesheet" type="text/css" href="login_f/css/main.css">

</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form action="" method="POST" class="login100-form validate-form">
					<span class="login100-form-logo">
						<!-- <i class="zmdi zmdi-landscape"></i> -->
						<img src="../images/icons/Logo-simbol-black.svg" alt="">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button name="submit" class="login100-form-btn">Login</button>
					</div>

				</form>
			</div>
		</div>
	</div>

</body>
</html>