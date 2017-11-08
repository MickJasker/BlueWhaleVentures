<?php
    require '../../Main/Includes/PHP/functions.php';
    checkSession('Client');
    checkRange();

    $id = checkExperimentID(secure($_GET['experimentID']), secure($_SESSION["CompanyID"]));

    if (isset($_SESSION["insertedIDPrototype"]) == false)
    {
        header('Location: prototype.php?experimentID=' . $id);
    }
    else
    {
        unset($_SESSION["insertedIDPrototype"]);
    }

    if (isset($_POST['save']))
    {
        //Image check
        $type = "img";
        $path = "../Uploads/prototypeImage/";
        $file1_name = $_FILES['file1']['name'];
        $file1_tmp_name = $_FILES['file1']['tmp_name'];
        $file1_size = $_FILES['file1']['size'];

        if (uploadCheck($file1_name, $file1_tmp_name, $file1_size, $type, $path) == false)
        {
            echo " - Error uploading image - ";
        }
        else
        {
            echo "1";
            //upload the image
            $imgResult = uploadExecute($file1_name, $file1_tmp_name, $path);
            $upload = true;
            $imagepath = "";
            if ($imgResult[0] == 1)
            {
                $imagepath = $imgResult[1];
            }
            else
            {
                $upload = false;
            }

            if ($upload)
            {
                //upload data to the database
                if (insertPrototype($imagepath ,$_POST['explanationText'], $experimentID))
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
    <title> New Prototype </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
</head>
<body id="wrapper-newPrototype">
<header class="wrapper-nav">
    <?php require "../nav_nosearch.php";?>
</header>
<Main class="row">
    <section class="col-lg-6">
        <div>
            <h1> New Prototype </h1>
            <div id="pitchForm">
                <form id="form" action="#" method="POST" enctype="multipart/form-data">

                    <textarea name="explanationText" placeholder="Explain your prototype"></textarea>
                    <label for="fileToUpload">Upload an image of your prototype</label>
                    <input type="file" name="file1" id="fileToUpload">
                    <input type="submit" name="save" value="Save">

                </form>
        </div>
    </section>
</Main>
</body>
</html>