<?php
    require '../../Main/Includes/PHP/functions.php';

    if(isset($_POST['submit'])) {
        insertQuestion($_POST, $_SESSION['insertedID']);
    }



?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script type="text/javascript" src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../../Main/Includes/Javascript/functions.js"></script>
</head>
    <body id="wrapper-admin">
        <Main>
            <h1> New Interview </h1>
            <div id="questionForm">
                <form id="form" action="#" method="POST">
                    <?php

                    $i = SelectQuestion($_SESSION['insertedID']);

                    ?>

                    <button type="button" onclick="addQuestion()">Add Question</button>
                    <input type="submit" name="submit" value="Save">
                    <p hidden id="hiddenP"><?php echo $i?></p>
                </form>
            </div>
        </Main>
    </body>
</html>