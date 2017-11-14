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
		<a href="index.php"> <button id="back" style="float:left; margin: 15px;"> Back </button> </a>
		<button style="float:right; margin: 15px; padding: 5px; min-width: 200px; font-size: 18px; height: 35px;" onclick="editExperiment();" > Edit experiment </button>
            <?php getExperiment($ID); ?>
            <br>
            <?php getFeedback($ID); ?>
        </main>
	</body>
</html>