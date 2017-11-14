<?php
	require '../../../Main/Includes/PHP/functions.php';
    checkSession('Client');  
	$ID = checkExperimentIDBachelor(secure($_GET["id"]), $_SESSION["CompanyID"]);

    if (isset($_POST['addFeedback']))
    {
        $feedback = secure($_POST["feedbackContent"]);
        if (!insertFeedback($ID, $UserID, $feedback))
        {
            echo "Error adding the feedback";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../../Main/Includes/CSS/main.css">
    <script src="../../../Main/Includes/Javascript/functions.js"></script>
</head>

<body id="wrapper-experimentExecuteable">
<header class="wrapper-nav">
    <?php require "nav_nosearch.php";?>
</header>
<main>
    <div id="experimentinfo">

        <?php getExperimentView($ID); ?>

    </div>

    <div id="textdiv">
        <h2>Add Feedback </h2>

        <form id="form" action="#" method="POST">
            <textarea id="text" name="feedbackContent"> </textarea> <br>
            <input type="submit" name="addFeedback" value="Add feedback">
        </form>
    </div>
    <?php getFeedbackBachelor($ID); ?>
</main>
</body>
</html>