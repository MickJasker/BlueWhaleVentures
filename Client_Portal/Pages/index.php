<?php
require '../../Main/Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
    <body id="wrapper-admin">
        <Main>
            <h1>Salty Mundi</h1>
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

            <?php

            getExperimentBlockInfo(7);

            ?>

        </Main>
    </body>
</html>