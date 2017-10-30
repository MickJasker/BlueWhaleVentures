<?php
require '../../Main/Includes/PHP/functions.php';

if(isset($_POST['submit'])) {
    insertAnswer($_POST, secure($_GET['experimentID']));
}


?>
<!DOCTYPE html>
<html>
<head>
    <title> Interview </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script type="text/javascript" src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
    <script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-admin">
<Main>
    <h1> Interview </h1>
    <div id="interviewForm">
        <form id="form" action="#" method="POST">

            <?php

                $i = selectQuestions($_GET['experimentID']);

            ?>
            <p hidden id="hiddenP"><?php echo $i?></p>
            <input type="submit" name="submit" value="Save">
        </form>
    </div>
</Main>
</body>
</html>