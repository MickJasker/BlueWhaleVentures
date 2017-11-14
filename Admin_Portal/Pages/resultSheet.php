<?php
	require '../../Main/Includes/PHP/functions.php';
	CheckSession("Admin");
    $experimentID = secure($_GET["experimentID"]);

?>

<!DOCTYPE html>
<html>
<head>
    <title> Admin Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-designSheet">
<header class="wrapper-nav">
    <?php require "../nav_nosearchadmin.php";?>
</header>
<main>
    <?php
    getDesignSheetDataGutted($experimentID, "Result", $_SESSION["Language"]);
    ?>
</main>

</body>
</html>