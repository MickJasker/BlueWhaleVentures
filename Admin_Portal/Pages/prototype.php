<?php
	require '../../Main/Includes/PHP/functions.php';
	CheckSession("Admin");
?>

<!DOCTYPE html>
<html>
<head>
    <title> Prototype </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-admin">
<Main>
    <h1> Prototype </h1>
    <div id="prototypeForm">
        <form id="form" action="#" method="POST" enctype="multipart/form-data">
            <?php $OldArray = selectPrototype(23); ?>
        </form>
    </div>
</Main>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title> Prototype </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-executable">
<header class="wrapper-nav">
    <?php require "../nav_nosearchadmin.php"; ?>
</header>
<Main>
    <div id="prototypeForm">
        <form id="form" action="#" method="POST" enctype="multipart/form-data">
            <?php $OldArray = selectPrototype($_GET["experimentID"]); ?>
        </form>
    </div>
</Main>
</body>
</html>