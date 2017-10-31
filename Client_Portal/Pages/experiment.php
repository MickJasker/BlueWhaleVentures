<?php
require '../../Main/Includes/PHP/functions.php';
$ID = secure($_GET["id"]);
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
    </main>
	<h2> Feedback </h2>
	<div>
		<?php getFeedback($ID); ?>
	</div>
	</body>
</html>