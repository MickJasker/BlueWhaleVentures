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
        <?php require "../nav_nosearch.php";?>
    </header>
    <main>
        <?php getExperiment($_GET["id"]); ?>
    </main>

		<!--<h1> Experiment 2</h1>
		<p> Experiment description </p>
		<p> Progress: </p>
		<p> Reviewscore: </p>
		<a href ="designSheet.php?experimentid=<?php //echo $_GET["id"];?>"><button> Design sheet </button></a>
		<button> Questionaire / pitch / prototype </button>
		<button> Results </button> 
		<a href ="resultSheet.php?experimentid=<?php// echo $_GET["id"];?>"><button> Results sheet </button> -->
	</body>
</html>