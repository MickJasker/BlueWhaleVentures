<?php
require '../../Main/Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title> Prototype </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
<body id="wrapper-admin">
<Main>
    <h1> Prototype </h1>
    <div id="prototypeForm">
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

            $OldArray[] = selectPrototype(23);

            if (array_key_exists(0 ,$OldArray)) {
                $OldMedia1 = $OldArray[0];
            }
            if (array_key_exists(1 ,$OldArray)) {
                $OldMedia2 = $OldArray[1];
            }

            ?>

        </form>
    </div>
</Main>
</body>
</html>