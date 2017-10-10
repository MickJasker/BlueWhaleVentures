<?php
    require '../../Main/Includes/PHP/functions.php';



    //Database functie fixen
    insertQuestion($_POST);

?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script type="text/javascript" src="../../Main/Includes/Javascript/newInterviewTemp.js"></script>
</head>
    <body id="wrapper-admin">
        <Main>
            <h1> New Interview </h1>
            <form action="#" method="POST">
                <div id="questionForm">
                <?php

                for ($i = 1; $i <= 1; $i++) {

                ?>

                    <textarea name="question<?php echo $i?>" placeholder="Question"></textarea>

                <?php

                }

                ?>

                </div>
                <button type="button" onclick="addQuestion()">Add Question</button>
                <input type="submit" value="Save">
                <p hidden id="hiddenP"><?php echo $i?></p>
            </form>

        </Main>
    </body>
</html>