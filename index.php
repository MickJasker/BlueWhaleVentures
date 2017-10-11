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
			<div class="col-lg-6"></div>
			<div class="col-lg-6 login_col login row">
				<div class="login_block ">
					<img src="Main/Files/Images/logo_text.svg" alt="logo">
					<form method="POST" action="#">
						<input type="text" placeholder="E-mail" name="user_name"><br>
						<input type="password" placeholder="Password" name="password"><br>
						<a href="#">Forgot password?</a><br>
						<input type="submit" name="login" class="button" value="Login">
						<p id="error">
							<?php
							require 'Main/Includes/PHP/functions.php';
							require "Main/Includes/Plugins/detectDevice/detect.php";
								
							if (isset($_POST['login']))
							{	
								$user_name = htmlentities(mysqli_real_escape_string($conn, $_POST['user_name']));
								$password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
								$state = "failed";
								
								$data = selectLoginInfo($user_name, $password);
								if ($data[0] == "true")
								{
									$role= $data[1];
									$UserID = $data[2];
									
									$header = "login";
									if ($role == "Admin")
									{
										$header = "Admin_Portal/Pages/index.php";
									}
									else if ($role == "Mentor")
									{
										$header = "Mentor_Portal/Pages/index.php";
									}
									else if ($role == "Company")
									{
										$header = "Client_Portal/Pages/index.php";
									}
									else
									{
										//User has no role
									}
									
									$state = "successful";
									loginlog($UserID, $state);
									
									createSession($user_name);
									header('Location:' . $header);
								}
								else
								{
									echo " - Error - ";
								}
							}
							?>
						</p>
					</form>
				</div>
			</div>
		</main>
	</body>
</html>