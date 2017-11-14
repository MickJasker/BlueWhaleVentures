<?php
	require '../../../Main/Includes/PHP/functions.php';
	checkSession('Client');
    $experimentID = checkExperimentIDBachelor(secure($_GET["experimentID"]), $_SESSION["UserID"]);
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
            <?php $OldArray = selectPrototype($experimentID); ?>
        </form>
    </div>
</Main>
</body>
</html>