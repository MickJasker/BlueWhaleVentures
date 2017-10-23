<?php
require '../../Main/Includes/PHP/functions.php';

if (isset($_POST['save']))
{
    //Image check
    $type = "mp4";
    $path = "../Uploads/pitchVideo/";
    $file1_name = $_FILES['file1']['name'];
    $file1_tmp_name = $_FILES['file1']['tmp_name'];
    $file1_size = $_FILES['file1']['size'];

    if (uploadCheck($file1_name, $file1_tmp_name, $file1_size, $type, $path) == false) {
        echo " - Error uploading image - ";
    }
    else
    {
        echo "1";
        //upload the image
        $videoResult = uploadExecute($file1_name, $file1_tmp_name, $path);
        $upload = true;
        $videopath = "";
        if ($videoResult[0] == 1)
        {
            $videopath = $videoResult[1];
        }
        else
        {
            $upload = false;
        }

        if ($upload)
        {
            //upload data to the database
            if (updatePitch($videopath , $_POST['preparationText'], $_POST['conclusionText']))
            {
                //header("Location: ");
            }
            else
            {
                echo "Something has gone wrong with uploading the data";
            }
        }
        else
        {
            echo "Error uploading the files";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Pitch </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
<body id="wrapper-admin">
<Main>
    <h1> Pitch </h1>
    <div id="pitchForm">
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

                selectPitch(1);

            ?>

        </form>
    </div>
</Main>
</body>
</html>