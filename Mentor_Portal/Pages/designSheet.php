<!DOCTYPE html>
<?php
require '../../Main/Includes/PHP/functions.php';
?>

<html>
	<head>
	    <title> Client Portal </title>
	    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
        <script src="../../Main/Includes/Javascript/functions.js"></script>
    </head>
	<body id="wrapper-designSheet">
        <header class="wrapper-nav">
            <?php require "../nav_nosearchmentor.php"; ?>
        </header>
        <main>
			<?php
            getDesignSheetDataGutted($_GET["experimentID"], "Experiment", $_SESSION["Language"]);
			?>
	</body>
</html>