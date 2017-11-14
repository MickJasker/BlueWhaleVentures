<?php
	require '../../Main/Includes/PHP/functions.php';
	checkSession('Mentor');
	$experimentID = checkExperimentIDMentor(secure($_GET["experimentID"]), $_SESSION["UserID"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Mentor Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-designSheet">
<header class="wrapper-nav">
    <?php require "../nav_nosearchmentor.php";?>
</header>
<main>
    <?php
    getDesignSheetDataGutted($experimentID, "Result", $_SESSION["Language"]);
    ?>
</main>

</body>
</html>