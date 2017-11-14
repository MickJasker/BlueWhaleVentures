<?php
    require '../../Main/Includes/PHP/functions.php';
    checkSession('Client');
    $experimentID = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Pitch </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-executable">
<header class="row wrapper-nav">
    <?php
    require "../nav_nosearch.php"
    ?>
</header>
<Main>
    <div id="pitchForm">
        <h1> Pitch </h1>
        <form id="form" action="#" method="POST" enctype="multipart/form-data">

            <?php

            $videopath = selectPitch($experimentID);


            if (isset($_POST['save']))
            {
				$check = true;
				if (!empty($_FILES['file1']['name']))
				{
					$type = "video";
					$path = "../Uploads/pitchVideo/";
					$file1_name = $_FILES['file1']['name'];
					$file1_tmp_name = $_FILES['file1']['tmp_name'];
					$file1_size = $_FILES['file1']['size'];

					if (uploadCheck($file1_name, $file1_tmp_name, $file1_size, $type, $path) == false) {
						$check = false;
					}
				}
                //Image check

				$upload = true;
                if ($check)
                {
                    $mainimageupload = true;
                    if (!empty($_FILES['file1']['name'])) {
                        if ($videopath != "")
                        {
                            if (!unlink($videopath)) {
                                echo "error deleting old image";
                                $mainimageupload = false;
                            }
                        }

                        if ($mainimageupload) {
                            //upload the image
							$path = "../../Client_Portal/Uploads/pitchVideo/";
							$file1_name = $_FILES['file1']['name'];
							$file1_tmp_name = $_FILES['file1']['tmp_name'];

                            $videoResult = uploadExecute($file1_name, $file1_tmp_name, $path);
                            if ($videoResult[0] == 1) {
                                $videopath = $videoResult[1];
                            } else {
                                $upload = false;
                            }
                        }
                    }

				if ($upload) {
					//upload data to the database
					if (updatePitch($videopath, $_POST['preparationText'], $_POST['conclusionText'], $experimentID)) {
						header("Location: pitch.php?experimentID=".$experimentID);
					} else {
						echo "Something has gone wrong with uploading the data";
					}
				} else {
					echo " - Error uploading the files - ";
				}
                }


            }
            ?>

        </form>
		<?php if ($_SESSION["traject"] == true) { ?>
			<button id="edit1" onclick='editPage(2, "pitch")'> Edit </button>
		<?php } ?>
    </div>
</Main>
</body>
</html>