<?php
require '../Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create account</title>
		<link rel="stylesheet" href="../Includes/CSS/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
		<script src="../Includes/Javascript/jquery-3.2.1.min.js"></script>
		<script src="../Includes/Javascript/load.js"></script>
	</head>
	<body id="wrapper-login">
      <?php
	//Get key form url
	$key = htmlentities(mysqli_real_escape_string($conn, $_GET['key']));
	if ($key == "")
	{
		echo "Wrong url!";
	}
	else{
	$data = getKey($key);
	if ($data[0] == "true")
	{
		$company_mail = $data[1];
		$firstname = $data[2];
	
    ?>
		<main class="row">

			<div class="col-lg-6 login_col login">
				<div class="login_block">
					<img src="../Files/Images/logo_text.svg" alt="logo">
					<form method="POST" action="#">
						<input type="text" name="user_name" placeholder="Name" value="<?php echo $firstname; ?>"> <br>
						<input type="text" name="company_mail" placeholder="E-mail" value="<?php echo $company_mail; ?>"> <br>
						<input type="password" name="password" placeholder="Password"> <br>
						<input type="password" name="password2" placeholder="Confirm Password"> <br>
						<input name="create_account" type="submit" value="Create account" class="button">
					</form>
					<p id="error">
					
					<?php
		
						if (isset($_POST['create_account']))
						{
							$firstname = htmlentities(mysqli_real_escape_string($conn, $_POST['user_name']));
							$company_mail = htmlentities(mysqli_real_escape_string($conn, $_POST['company_mail']));
							$password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
							$password2 = htmlentities(mysqli_real_escape_string($conn, $_POST['password2']));
							$key = htmlentities(mysqli_real_escape_string($conn, $_GET["key"]));
							$role = "";
							
							if (!(strlen($firstname) >= 1 && strlen($firstname) <= 32))
							{
								echo "The name should be between 1 and 32 characters";
							}
							else if ($password != $password2)
							{
								echo "The passwords do not match";
							}
							else if (!(preg_match("#[A-Z]+#", $password) && preg_match("#[a-z]+#", $password) && preg_match("#[0-9]+#", $password)))
							{
								echo "The password should atleast contain one lowercase letter, one uppercase letter and one number";
							}
							else if (!(strlen($password) >= 8 && strlen($password) <= 60))
							{
								echo "The password should be between 8 and 60 characters";
							}
							else if (!filter_var($company_mail, FILTER_VALIDATE_EMAIL))
							{
								echo "The E-mail adress is not correct";
							}
							else if (!checkEmailAvailability2($company_mail))
							{
								echo "Already an account with that e-mail adress exists";
							}
							else
							{
								//Implement check key, get user data from db function
								if($role = checkKey($key))
								{
									if (createAccount($role, $firstname, $company_mail, $password)) 
									{
										header('Location: ../../index.php');
									}
									else
									{
										echo "Error creating account";
									}
								
								}
								else
								{
									echo "- Error -";
								}
							}
						}
					}
					else
					{
						echo " - Error - ";
					}
					}//Close if ($key == 0)

					 ?>
					
					</p>
				</div>

			</div>
			<div class="col-lg-6"></div>
		</main>
	</body>
</html>