<?php
	require '../../../Main/Includes/PHP/functions.php';
	CheckSession("Client");
?>

<!DOCTYPE html>
<html>
	<head>
	    <title> Client Portal </title>
	    <link rel="stylesheet" href="../../../Main/Includes/CSS/main.css">
	</head>
	<body id="wrapper-designSheet">
        <header class="wrapper-nav">
            <?php require "nav_nosearch.php"; ?>
        </header>
        <main>
			<?php
                getDesignSheetDataGutted($_GET["experimentID"], "Experiment", $_SESSION["Language"]);
			?>
	</body>
</html>