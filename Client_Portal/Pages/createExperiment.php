<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
checkRange();
?>
<!DOCTYPE html>
<html>
<head>
    <title> Create a new design sheet </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
	<body id="wrapper-experiment">
    <header class="row wrapper-nav">
        <?php require "../nav_nosearch.php";?>
    </header>
		<Main id="wrapper-createExperiment">
            <div class="row">
                <section class="col-lg-6">
                    <div>
                        <h1> New experiment </h1>
                        <form method="POST" action="#" enctype="multipart/form-data">
                           <input type="text" name="title" placeholder="Title"> <br>
                            <input type="file" name="file1" id="file1"> <label for="file1">Upload a thumbnail</label> <br>
                            <textarea name="description" type="text" placeholder="Description"></textarea> <br>
                            <input name="submitExperiment" type="submit" value="Enter" id="button">
                        </form>
                        <?php
                        if (isset($_POST['submitExperiment']))
                        {
                            $title = htmlentities(mysqli_real_escape_string($conn, $_POST['title']));
                            $description = htmlentities(mysqli_real_escape_string($conn, $_POST['description']));

                            //Image check
                            $type = "img";
                            $path = "../../Client_Portal/Uploads/ExperimentThumbnail/";
                            $file1_name = $_FILES['file1']['name'];
                            $file1_tmp_name = $_FILES['file1']['tmp_name'];
                            $file1_size = $_FILES['file1']['size'];

                            if (uploadCheck($file1_name, $file1_tmp_name, $file1_size, $type, $path) == false)
                            {
                                echo " - Error uploading image - ";
                            }
                            else if ($title == "")
                            {
                                echo "No title has been given";
                            }
                            else if ($description == "")
                            {
                                echo "No description has been given";
                            }
                            else
                            {
                                //upload the image
                                $imgResult = uploadExecute($file1_name, $file1_tmp_name, $path);
                                $upload = true;
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
                                    $companyid = $_SESSION["CompanyID"];
                                    //upload data to the database
                                    if ($experimentId = createExperiment($title, $description, $imagepath, $companyid))
                                    {
                                        header("Location: createDesignSheet.php?experimentID=" . $experimentId);
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
                    </div>

                </section>

            </div>

		</Main>
	</body>
</html>