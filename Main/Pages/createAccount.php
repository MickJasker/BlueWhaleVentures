<?php
	require '../Includes/PHP/queries.php';
	require '../Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
   <head>
	<title> Create an Account </title>
   </head>
   <body>
   <?php
	//Get key form url	
	$key = htmlentities(mysqli_real_escape_string($conn, $_GET['key']));
	if ($key == "")
	{
		echo "Wrong url!";
	}
	else{
	//Implement check key, get user data from db function
	
   ?>
   
	<form method="POST" action="#">
		<input type="text" name="user_name" placeholder="Name"> <br>
		<input type="text" name="company_mail" placeholder="E-mail"> <br>
		<input type="password" name="password" placeholder="Password"> <br>
		<input type="password" name="password2" placeholder="Confirm Password"> <br>
		<input name="create_account" type="submit" value="Create account">
	</form>
	
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
			else
			{
				if($role = checkKey($key))
				{
					if (createAccount($role, $user_name, $company_mail, $password)) 
					{
						header('Location: ../../Admin_Portal/Pages/index.php');
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
	}//Close if ($key == 0)

		?>
	
	</body>
</html>