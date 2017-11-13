<?php

    include_once '../../Main/Includes/PHP/functions.php';

    //CheckSession("Admin");

if (isset($_POST['saveBachelorGroup']))
{
    insertBachelorGroup(secure($_POST['name']));
}

if (isset($_GET['action']))
{
	if (secure($_GET['action']) == "delete") 
	{
        deleteBachelorGroup(secure($_GET['bachelorID']));
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title> Admin Portal </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
    <script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
    <script src="../../Main/Includes/Javascript/load.js"></script>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <link rel="icon" href="../../Main/Files/Images/icon.svg"/>
    <script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-admin-body">

<script src="../../Main/Includes/Javascript/load.js"></script>

<header class="wrapper-nav">

    <?php include '../nav.php'; ?>

</header>

<Main id="wrapper-admin">

<?php		
				if (isset($_POST['generate_mentorkey']))
				{
					echo '<p>';
					$user_name = htmlentities(mysqli_real_escape_string($conn, $_POST['user_name']));
					$company_mail = htmlentities(mysqli_real_escape_string($conn, $_POST['company_mail']));

					if (!(strlen($user_name) >= 1 && strlen($user_name) <= 32))
					{
						echo "The name should be between 1 and 32 characters";
					}
					else if (!filter_var($company_mail, FILTER_VALIDATE_EMAIL))
					{
						echo "The E-mail adress is not correct";
					}
					else
					{
						generate_key($company_mail, $user_name, "Mentor");
					}
					echo '</p>';
				}
?>

    <?php include 'client.php'; ?>

</Main>

<script src="../../Main/Includes/Javascript/main.js"></script>
</body>
</html>