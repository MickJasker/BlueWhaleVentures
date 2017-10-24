<?php
require '../../Main/Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title> Prototype </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
<body id="wrapper-admin">
<Main>
    <h1> Prototype </h1>
    <div id="prototypeForm">
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

            $OldArray[] = selectPrototype(23);

            if (array_key_exists(0 ,$OldArray)) {
                $OldMedia1 = $OldArray[0];
            }
            if (array_key_exists(1 ,$OldArray)) {
                $OldMedia2 = $OldArray[1];
            }


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
                    $mainimageupload = true;
                    if (!empty($_FILES['file1']['name']))
                    {
                        if (!unlink($OldMedia))
                        {
                            echo "error deleting old image";
                            $mainimageupload = false;
                        }
                    }

                    if ($mainimageupload) {
                        //upload the image
                        $videoResult = uploadExecute($file1_name, $file1_tmp_name, $path);
                        $upload = true;
                        $videopath = "";
                        if ($videoResult[0] == 1) {
                            $videopath = $videoResult[1];
                        } else {
                            $upload = false;
                        }

                        if ($upload) {
                            //upload data to the database
                            if (updatePitch($videopath, $_POST['preparationText'], $_POST['conclusionText'])) {
                                header("Location: pitch.php");
                            } else {
                                echo "Something has gone wrong with uploading the data";
                            }
                        } else {
                            echo "Error uploading the files";
                        }
                    }
                }
            }



            ?>

        </form>
    </div>
</Main>
</body>
</html>