<?php
	require '../../../Main/Includes/PHP/functions.php';
	checkSession('Client');
	$experimentID = checkExperimentIDBachelor(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../../Main/Includes/CSS/main.css">
    <script src="../../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-designSheet">
<header class="wrapper-nav">
    <?php require "nav_nosearch.php";?>
</header>
<main>
    <?php
    getDesignSheetDataGutted($experimentID, "Result", $_SESSION["Language"]);
    ?>
</main>

</body>
</html>