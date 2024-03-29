<?php
    require '../../Main/Includes/PHP/functions.php';
    checkSession('Client');
    $experimentID = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
    if(isset($_POST['submit']))
    {
        insertAnswer($_POST, secure($experimentID));
        header('Location: experiment.php?id='.$_GET['experimentID']);
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
    <body id="wrapper-executable">
        <header class="row wrapper-nav">
            <?php require "../nav_nosearch.php"; ?>
        </header>
        <Main>
            <div id="interviewForm">
                <h1> Interview </h1>
                <a href="editInterview.php?experimentID=<?php echo $_GET['experimentID']; ?>"><button id="add"> Add more questions </button></a>
                <form id="form" action="#" method="POST">
                    <?php $i = selectQuestions($experimentID); ?>
                    <p hidden id="hiddenP"><?php echo $i?></p>
                    <?php if($_SESSION["traject"] == true) { echo '<input class="save" type="submit" name="submit" value="Save">'; } ?>
                </form>
            </div>
        </Main>
    </body>
</html>