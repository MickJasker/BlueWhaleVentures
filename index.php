<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="Main/Includes/CSS/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
		<script src="Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
		<script src="Main/Includes/Javascript/load.js"></script>
	</head>

	<body id="wrapper-login">
		<main class="row">
			<div class="col-lg-6 login_col"></div>
			<div class="col-lg-6 login_col login row">
				<div class="login_block ">
					<img src="Main/Files/Images/logo_text.svg" alt="logo">
					<form action="#">
						<input type="text" placeholder="User name"><br>
						<input type="password" placeholder="Password"><br>
						<a href="#">Forgot password?</a><br>
						<input type="button" class="button" value="Login">
						<p id="error">PHP error handling!!!</p>
					</form>
				</div>
			</div>
		</main>
	</body>
</html>