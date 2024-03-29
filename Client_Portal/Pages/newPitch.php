<?php
    require '../../Main/Includes/PHP/functions.php';
	checkSession('Client');
    checkRange();    

    $id = secure($_GET["experimentID"]);

    if (isset($_POST["insertedID"]))
    {
        $_SESSION["insertedID"] = $_POST["insertedID"];
    }

    if(isset($_POST['submit']))
    {
        if (isset($_SESSION['insertedID']))
        {
            if (insertPitch(secure($_POST['preparationText']), secure($_SESSION['insertedID'])))
            {
                header('Location: experiment.php?id=' . $id);
            }
        } 
        else
        {
            if (insertPitchWithExperimentID(secure($_POST['preparationText']), secure($_GET['experimentID'])))
            {
                header('Location: experiment.php?id=' . $id);
            }
        }
    }

    if (isset($_SESSION["insertedID"]) == false)
    {
        header('Location: pitch.php?experimentID=' . $id);
    }
    else
    {
        unset($_SESSION["insertedID"]);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> New Pitch </title>
        <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    </head>
    <body id="wrapper-newPrototype">
        <header class="wrapper-nav">
            <?php require "../nav_nosearch.php"; ?>
        </header>
        <Main class="row">
            <section class="col-lg-6">
                <div>
                    <h1> New Pitch </h1>
                    <div id="pitchForm">
                        <form id="form" action="#" method="POST">

                            <textarea name="preparationText" placeholder="Prepare for your pitch"></textarea>
                            <input type="submit" name="submit" value="Save">

                        </form>
                    </div>
                </div>
            </section>
        </Main>
    </body>
</html>