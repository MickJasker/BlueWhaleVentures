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
    require "../nav_client.php"
    ?>
</header>
<Main id="wrapper-admin">
    <ul class="list">
        <div class="content">
            <?php

            getExperimentBlockInfo(12);

            ?>
        </div>
    </ul>
</Main>

<script src="../../Main/Includes/Javascript/main.js"></script>

</body>
</html>