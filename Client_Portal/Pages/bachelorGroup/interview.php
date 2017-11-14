<?php
    require '../../../Main/Includes/PHP/functions.php';
    checkSession('Client');
    $experimentID = checkExperimentIDBachelor(secure($_GET["experimentID"]), $_SESSION["UserID"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Interview </title>
    <link rel="stylesheet" href="../../../Main/Includes/CSS/main.css">
    <script type="text/javascript" src="../../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
    <script src="../../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-executable">
<header class="row wrapper-nav">
    <?php require "nav_nosearch.php"; ?>
</header>
<Main>
    <div id="interviewForm">
        <h1> Interview </h1>
        <form id="form" action="#" method="POST">
            <?php $i = selectQuestionsView($experimentID); ?>
        </form>
    </div>
</Main>
</body>
</html>