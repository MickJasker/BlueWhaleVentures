<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Mentor');
?>
<!DOCTYPE html>
<html>
<head>
    <title> Pitch </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-admin">
<Main>
    <h1> Pitch </h1>
    <div id="pitchForm">
        <form id="form" action="#" method="POST" enctype="multipart/form-data">
            <?php $OldMedia = selectPitch(1); ?>
        </form>
    </div>
</Main>
</body>
</html>