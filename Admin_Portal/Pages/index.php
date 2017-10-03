<!DOCTYPE html>
<html>
   <head>
	<title> Admin_Portal </title>
   </head>
   <body>
	<form method="POST" action="#">
		<input type="text" name="company_name" placeholder="Name"> <br>
		<input type="text" name="company_mail" placeholder="E-mail"> <br>
		<input name="generate_companykey" type="submit" value="New company">
	</form>
		<?php	
		require '../../Main/Includes/PHP/functions.php';
		
		if (isset($_POST['generate_companykey']))
		{
			//$company_name = htmlentities(mysqli_real_escape_string($conn, $_POST['company_name']));
			//$company_mail = htmlentities(mysqli_real_escape_string($conn, $_POST['company_mail']));
			$company_name = htmlentities($_POST['company_name']);
			$company_mail = htmlentities($_POST['company_mail']);
			
			generate_key($company_mail, $company_name, "company");
		}

		?>
	</body>
</html>