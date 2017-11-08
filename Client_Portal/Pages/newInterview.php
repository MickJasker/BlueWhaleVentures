<?php
    require '../../Main/Includes/PHP/functions.php';
	checkSession('Client');
    checkRange();

    $id = secure($_GET['experimentID']);

    if (isset($_SESSION["insertedIDInterview"]) == false)
    {
        header('Location: interview.php?experimentID=' . $id);
    }
    else
    {
        unset($_SESSION["insertedIDInterview"]);
    }  
  
    if (isset($_POST['submit']))
    {
        if(isset($_SESSION['insertedIDInterview']))
        {
            insertQuestion($_POST, $_SESSION['insertedIDInterview']);
        }
        else
        {
            insertQuestionWithExperimentID($_POST, $id);
        }

        header('Location: experiment.php?id='.$id);
    }
    
    $i = 0;    
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script type="text/javascript" src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../../Main/Includes/Javascript/functions.js"></script>
</head>
    <body id="wrapper-newPrototype">
    <header class="wrapper-nav">
        <?php require "../nav_nosearch.php"; ?></header>
        <Main>
            <section class="col-lg-6">
                <div id="questionForm">
                    <h1> New Interview </h1>
                    <form id="form" action="#" method="POST">
                        <p hidden id="hiddenP"><?php echo $i?></p>
                        <?php
                            if(isset($_SESSION['insertedID']))
                            {
                                $i = SelectQuestion($_SESSION['insertedID']);
                            }
                            else
                            {
                                $i = SelectQuestionWithExperimentID(secure($_GET['experimentID']));
                            }
                        ?>

                        <button type="button" onclick="addQuestion()">Add Question</button>
                        <input type="submit" onclick="return confirm('Are you sure you are done adding questions? You can not add new ones when you leave this page!')" name="submit" value="Save"><br>
                    </form>
                </div>
            </section>
        </Main>
    </body>
</html>