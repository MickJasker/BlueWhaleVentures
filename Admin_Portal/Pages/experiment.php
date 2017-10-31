<?php
require '../../Main/Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
	    <title> Client Portal </title>
	    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
		<script src="../../Main/Includes/Javascript/functions.js"></script>
	</head>

	<body id="wrapper-experimentExecuteable">
	    <header class="wrapper-nav">
	        <?php require "../nav_nosearchadmin.php";?>
	    </header>
	    <main>
	        <?php getExperimentView($_GET["id"]); ?>
	    </main>
	</body>
</html>