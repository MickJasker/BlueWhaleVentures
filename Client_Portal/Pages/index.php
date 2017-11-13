<?php
    include_once '../../Main/Includes/PHP/functions.php';
    checkSession('Client');
?>

<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
    <script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
</head>
<body id="wrapper-client-body">
<header class="row wrapper-nav">
    <?php
    require "../nav_client.php"
    ?>
</header>
<Main id="wrapper-admin">
    <?php

    include 'experiments.php';

    ?>
</Main>

<footer>
<?php $currentDay = selectTimeline($_SESSION["CompanyID"]); 
	echo '<p hidden id="currentday">'. $currentDay . '</p>';
?>
    <div id="progressbar">
        <div id="bar"></div>
        <div id="grow" class="milestone">0</div>
        <div class="milestone left1">25</div>
        <div class="milestone left2">50</div>
        <div class="milestone left2">75</div>
        <div class="milestone right">100</div>

    </div>
</footer>

<script src="../../Main/Includes/Javascript/main.js"></script>
<script src="../../Main/Includes/Javascript/progressbar.js"></script>

</body>
</html>