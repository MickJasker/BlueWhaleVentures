<?php
	require '../../Main/Includes/PHP/functions.php';
	checkSession('Mentor');
    $experimentID = checkExperimentIDMentor(secure($_GET["experimentID"]), $_SESSION["UserID"]);

?>

<!DOCTYPE html>
<html>
<head>
    <title> Prototype </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-executable">
<header class="wrapper-nav">
    <?php require "../nav_nosearchmentor.php"; ?>
</header>
<Main>
    <div id="prototypeForm">
        <h1> Prototype </h1>
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

            $path = "../../Client_Portal";
            $OldArray = selectPrototype($experimentID, $path);

            ?>

        </form>
    </div>
</Main>
</body>
</html>