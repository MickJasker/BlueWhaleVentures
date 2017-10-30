<?php
require '../../Main/Includes/PHP/functions.php';
CheckSession("Client");
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
<body id="wrapper-admin-body">
<header class="row wrapper-nav">
    <?php
    require "../../Main/Includes/nav.php"
    ?>
</header>
<Main id="wrapper-admin">
    <div class="row">
        <section id="Block">
            <a href="createExperiment.php">
                <div class="BlockLogo">
                    <img src="../../Main/Files/Images/blue_plus.png" alt="Add Client">
                </div>
                <div class="BlockTitle">
                    <h1> Add Experiment </h1>
                </div>
            </a>
        </section>

        <?php getExperimentBlockInfo($_SESSION["CompanyID"]); ?>
        
    </div>
</Main>
</body>
</html>