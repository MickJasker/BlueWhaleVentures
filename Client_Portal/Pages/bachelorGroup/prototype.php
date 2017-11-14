<?php
	require '../../../Main/Includes/PHP/functions.php';
	checkSession('Client');
    $experimentID = checkExperimentIDBachelor(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Prototype </title>
    <link rel="stylesheet" href="../../../Main/Includes/CSS/main.css">
    <script src="../../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-executable">
<header class="wrapper-nav">
    <?php require "nav_nosearch.php"; ?>
</header>
<Main>
    <div id="prototypeForm">
        <h1> Prototype </h1>
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

            $OldArray = selectPrototype($experimentID);

            ?>

        </form>
    </div>
</Main>
</body>
</html>