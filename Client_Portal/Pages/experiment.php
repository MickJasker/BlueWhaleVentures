<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
$ID = checkExperimentID(secure($_GET["id"]), $_SESSION["CompanyID"]);
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
            <?php require "../nav_nosearch.php";?>
        </header>
        <main>
            <?php getExperiment($ID); ?>
            <br>
            <?php getFeedback($ID); ?>
        </main>
	</body>
</html>