<?php
	require '../../Main/Includes/PHP/functions.php';
	checkSession('Mentor');
?>

<!DOCTYPE html>
<html>
<head>
    <title> Mentor Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
	<body id="wrapper-client-welcome">
		<h3> Welcome <?php getUserNames($_SESSION["UserID"]); ?>,</h3>	
		<p> On this portal you are able to view and give feedback on experiments from clients at BW Ventures<p>
		<p> Before you begin please fill some data in about you and your company</br></br> <a href="profile.php"> Edit my profile </a> </p>
		<p> Greetings,</br> Maarten </p>
	</body>
</html>