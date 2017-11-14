<?php
	require '../../../Main/Includes/PHP/functions.php';
	checkSession('Client');
	$experimentID = checkExperimentIDBachelor(secure($_GET["experimentID"]), $_SESSION["UserID"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Pitch </title>
    <link rel="stylesheet" href="../../../Main/Includes/CSS/main.css">
    <script src="../../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-executable">
<header class="row wrapper-nav">
    <?php
    require "nav_nosearch.php"
    ?>
</header>
<Main>
    <div id="pitchForm">
        <h1> Pitch </h1>
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

            $videopath = selectPitch(secure($_GET['experimentID']));

            ?>

        </form>
    </div>
</Main>
</body>
</html>