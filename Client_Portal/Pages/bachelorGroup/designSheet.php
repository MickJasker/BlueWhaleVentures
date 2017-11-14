<?php
	require '../../../Main/Includes/PHP/functions.php';
	CheckSession("Client");
	$experimentID = checkExperimentIDBachelor(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
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
                getDesignSheetDataGutted($experimentID, "Experiment", $_SESSION["Language"]);
			?>
	</body>
</html>