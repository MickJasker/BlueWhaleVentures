<?php
	require '../../Main/Includes/PHP/functions.php';
	checkSession('Client');
?>

<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-client-body">
	<h3> Welcome <?php getUserNames($_SESSION["UserID"]); ?>,</h3>
	<p> On this portal you are able to add experiments <p>
	<p> Before you begin please fill some data in about you and your company</br></br><a href="profile.php"> Edit my profile </a> </p>
	</br>
	<p> Greetings,</br> Maarten </p>
</body>

</html>