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
    <body id="wrapper-admin">
	<?php  
		getExperiment($_GET["id"]);
	
	?>
		<!--<h1> Experiment 2</h1>
		<p> Experiment description </p>
		<p> Progress: </p>
		<p> Reviewscore: </p>
		<a href ="designSheet.php"><button> Design sheet </button></a>
		<button> Questionaire / pitch / prototype </button>
		<button> Results </button> 
		<button> Results sheet </button> -->
	</body>
</html>