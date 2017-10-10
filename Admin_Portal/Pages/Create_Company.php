<?php
require '../../Main/Includes/PHP/functions.php';
?>

<form method="POST" action="#">
	<input type="text" name="user_name" placeholder="User name"> <br>
	<input type="text" name="company_mail" placeholder="E-mail"> <br>
	<input name="generate_companykey" type="submit" value="New company">
</form>
<?php
		
	if (isset($_POST['generate_companykey']))
	{
		$user_name = htmlentities(mysqli_real_escape_string($conn, $_POST['user_name']));
		$company_mail = htmlentities(mysqli_real_escape_string($conn, $_POST['company_mail']));
		
		generate_key($company_mail, $user_name, "Company");
	}

?>
