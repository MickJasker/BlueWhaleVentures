<?php
	require '../../../Main/Includes/PHP/functions.php';
    checkSession('Client');
    $ID = checkBachelor(secure($_GET["id"]), $_SESSION["CompanyID"]);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Client Profile</title>
		<link rel="stylesheet" href="../../../Main/Includes/CSS/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
		<script src="../../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
		<script src="../../../Main/Includes/Javascript/load.js"></script>
        <script src="../../../Main/Includes/Javascript/main.js"></script>
    </head>

	<body id="wrapper-ClientProfile">
		<header class="row wrapper-nav">
			<?php require "nav_nosearch.php"; ?>
		</header>
		<main>
			<?php 
				selectCompanyInfoGutted($ID); 
			?>
		</main>
		<script src="../../../Main/Includes/Javascript/navbar.js"></script>
        <script src="../../../Main/Includes/Javascript/main.js"></script>
    </body>
</html>