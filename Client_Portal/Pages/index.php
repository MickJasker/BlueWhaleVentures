<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-admin-body">
<header class="row wrapper-nav">
    <?php
    require "../nav_client.php"
    ?>
</header>
<Main id="wrapper-admin">
    <ul class="list">
        <div class="content">

            <div id="Block" class="col-lg-4">
                <a class="mentorbutton" href="createExperiment.php">
                    <div class="BlockLogo">
                        <img src="../../Main/Files/Images/add.svg" alt="Add Experiment">
                    </div>
                    <div class="BlockTitle">
                        <h1> Add Experiment </h1>
                    </div>
                </a>
            </div>

            <?php getExperimentBlockInfo($_SESSION["CompanyID"]); ?>
        </div>
    </ul>
</Main>

<footer>
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

</body>
</html>