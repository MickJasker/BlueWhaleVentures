<?php
require '../../Main/Includes/PHP/functions.php';
CheckSession("Admin");
?>
<!DOCTYPE html>
<html>
<head>
    <title> Bachelor Group </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
<body id="wrapper-admin-body">
<header class="row wrapper-nav">
    <?php
    require "../nav.php"
    ?>
</header>
<Main id="wrapper-admin">
    <ul class="list">
        <div class="content">

            <div onclick="addToBachelorGroup()" id="Block" class="col-lg-4">
                <a class="clientbutton" href="#">
                    <div class="BlockLogo">
                        <img src="../../Main/Files/Images/add.svg" alt="Add To Bachelor Group">
                    </div>
                    <div class="BlockTitle">
                        <h1> Add To Bachelor Group </h1>
                    </div>
                </a>
            </div>

            <?php

               selectBachelorGroupBlockInfo(secure($_GET['id']));

            ?>
        </div>
    </ul>
</Main>

<script src="../../Main/Includes/Javascript/main.js"></script>

</body>
</html>