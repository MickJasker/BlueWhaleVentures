<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
$experimentID = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title> Prototype </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-executable">
<header class="wrapper-nav">
    <?php require "../nav_nosearch.php"; ?>
</header>
<Main>
    <div id="prototypeForm">
        <h1> Prototype </h1>
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

            $OldArray = selectPrototype($experimentID);
            $OldMedia1 = "";
            $OldMedia2 = "";

            if (array_key_exists(0 ,$OldArray)) {
                $OldMedia1 = $OldArray[0];
            }
            if (array_key_exists(1 ,$OldArray)) {
                $OldMedia2 = $OldArray[1];
            }


            if (isset($_POST['save'])) {
                $upload = false;
                if (!empty($_FILES['file1']['name'])) {
                    //Image check
                    $type = "img";
                    $path = "../Uploads/prototypeImage/";
                    $file1_name = $_FILES['file1']['name'];
                    $file1_tmp_name = $_FILES['file1']['tmp_name'];
                    $file1_size = $_FILES['file1']['size'];

                    if (uploadCheck($file1_name, $file1_tmp_name, $file1_size, $type, $path) == false) {
                        echo " - Error uploading image - ";
                    } else {
                        $mainimageupload = true;

                            if ($OldMedia1 == "") {

                            }
                            else if (!unlink($OldMedia1)) {
                                echo "error deleting old image";
                                $mainimageupload = false;
                            }


                        if ($mainimageupload) {
                            //upload the image
                            $imageResult = uploadExecute($file1_name, $file1_tmp_name, $path);
                            $upload = true;
                            $imagepath = "";
                            if ($imageResult[0] == 1) {
                                $imagepath = $imageResult[1];
                            } else {
                                $upload = false;
                            }
                        }
                    }
                }
                else
                {
                    $imagepath = $OldMedia1;
                }

                if (!empty($_FILES['file2']['name'])) {
                    //Image check
                    $type2 = "img";
                    $path2 = "../Uploads/prototypeImage/";
                    $file2_name = $_FILES['file2']['name'];
                    $file2_tmp_name = $_FILES['file2']['tmp_name'];
                    $file2_size = $_FILES['file2']['size'];

                    if (uploadCheck($file2_name, $file2_tmp_name, $file2_size, $type2, $path2) == false) {
                        echo " - Error uploading image - ";
                    } else {
                        $mainimageupload = true;

                            if ($OldMedia2 == "") {

                            }
                            else if (!unlink($OldMedia2)) {
                                    echo "error deleting old image";
                                    $mainimageupload = false;
                                }
                            }


                        if ($mainimageupload) {
                            //upload the image
                            $imageResult1 = uploadExecute($file2_name, $file2_tmp_name, $path2);
                            $upload = true;
                            $imagepath1 = "";
                            if ($imageResult1[0] == 1) {
                                $imagepath1 = $imageResult1[1];
                            } else {
                                $upload = false;
                            }
                            }
                        }
                        else
                        {
                            $imagepath1 = $OldMedia2;
                        }
                        if ($upload) {
                            //upload data to the database
                            if (updatePrototype($experimentID, $imagepath, $_POST['explanation1'], $imagepath1, $_POST['explanation2'])) {
                                header("Location: prototype.php");
                            } else {
                                echo "Something has gone wrong with uploading the data";
                            }
                        } else {
                            echo "Error uploading the files";
                        }
                    }
            ?>

        </form>
		<?php if ($_SESSION["traject"] == true) { ?>
			<button id="edit1" onclick='editPage(2, "prototype")'> Edit </button>
		<?php } ?>
    </div>
</Main>
</body>
</html>