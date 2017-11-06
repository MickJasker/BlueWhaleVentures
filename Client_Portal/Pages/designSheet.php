<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
$experimentID = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
if (isset($_POST["submitDesignsheet"])) 
{
	updateDesignSheet($_POST, "Experiment", $_SESSION["Language"], $experimentID);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
    <body id="wrapper-designSheet">
    <header class="wrapper-nav">
        <?php require "../nav_nosearch.php";?>
    </header>
    <main>

            <?php
            getDesignSheetData($experimentID, "Experiment", $_SESSION["Language"]);
            ?>

    </main>

	</body>
</html>