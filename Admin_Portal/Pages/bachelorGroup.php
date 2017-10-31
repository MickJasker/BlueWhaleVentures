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
            <?php selectBachelorGroupBlockInfo(secure($_GET['id'])); ?>
        </div>
    </ul>
</Main>

<script src="../../Main/Includes/Javascript/main.js"></script>

</body>
</html>