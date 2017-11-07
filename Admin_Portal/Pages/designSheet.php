<!DOCTYPE html>
<?php
require '../../Main/Includes/PHP/functions.php';
?>

<html>
	<head>
	    <title> Admin Portal </title>
	    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	</head>
	<body id="wrapper-designSheet">
        <header class="wrapper-nav">
            <?php require "../nav_nosearchadmin.php"; ?>
        </header>
        <main>
			<?php
				getDesignSheetData($_GET["experimentID"], "Experiment", $_SESSION["Language"]);
			?>
	</body>
</html>