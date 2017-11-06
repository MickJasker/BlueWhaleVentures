<?php
require '../../Main/Includes/PHP/functions.php';
CheckSession("Mentor");
?>

<!DOCTYPE html>
<html>
<head>
    <title> Mentor Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
<body id="wrapper-admin-body">
<header class="wrapper-nav">
    <?php require "../nav_nosearchmentor.php"; ?>
</header>
<Main id="wrapper-profile">

    <div class="content">

        <div class="profile">
            <div class="picture">
                <?php
                $ID = $_SESSION["UserID"];
                $data = getMentorProfile($ID);
                ?>

                <?php if ($data[2] != "")
                {
                    echo '<img src="'.$data[2].'" alt="Profile picture" height="100px">';
                }
                ?>
            </div>
            <div class="name">
                <h1><?php echo $data[1]; ?></h1>
            </div>
        </div>

        <div class="info">

            <div class="title">
                <h1>Information</h1>
            </div>

            <div class="text">

                <div class="info1">
                    <form id="form" action="#" method="POST" enctype="multipart/form-data">
                        <h1>Profile picture</h1>
                        <input type="file" name="file1" id="file1">
                        <br>
                        <h1>General information</h1><br>
                        <p>Name</p>
                        <input type="text" name="name" placeholder="Name" value="<?php echo $data[1]; ?>"><br>

                        <h1>Contact</h1><br>
                        <input type="text" name="email" placeholder="E-mail" value="<?php echo $data[3]; ?>"> <br>
                        <input type="text" name="companyName" placeholder="Company name" value="<?php echo $data[4]; ?>"> <br>
                        <input type="text" name="phone" placeholder="Phone" value="<?php echo $data[5]; ?>"> <br>

                        <br>
                        <h1>Language</h1>
                        <br>
                        <select name="language">
                            <?php selectLanguage($ID); ?>
                        </select> <br><br>

                        <input class="submit" type="submit" name="submit" value="Save">
                    </form>
					<?php
				if (isset($_POST['submit']))
                    {
                        $name = secure($_POST['name']);
                        $email = secure($_POST['email']);
                        $language = secure($_POST['language']);
                        $companyName = secure($_POST['companyName']);
                        $phone = secure($_POST['phone']);

                        $upload = true;
                        $check = true;

                        if (!(strlen($name) >= 1 && strlen($name) <= 32))
                        {
                            $check = false;
                            echo "The name should be between 1 and 32 characters";
                        }
                        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            $check = false;
                            echo "The E-mail adress is not correct";
                        }
                        else if (!(strlen($phone) >= 6 && strlen($phone) <= 20 && is_numeric($phone)))
                        {
                            $check = false;
                            echo "The phone number is empty or not correct";
                        }
                        else if (!(strlen($companyName) >= 2 && strlen($companyName) <= 50))
                        {
                            $check = false;
                            echo "The companyName is empty or not between 2 and 50 characters";
                        }

                        if ($check)
                        {
                            //Profile picture upload
                            $PFPath = "";
                            if (!empty($_FILES['file1']['name']))
                            {
                                $type = "img";
                                $path = "../../Mentor_Portal/Uploads/profilePictures/";
                                $file1_name = $_FILES['file1']['name'];
                                $file1_tmp_name = $_FILES['file1']['tmp_name'];
                                $file1_size = $_FILES['file1']['size'];

                                if ($data[2] != "")
                                {
                                    if (!unlink("".$data[2]))
                                    {
                                        echo "error deleting old image";
                                        $upload = false;
                                    }
                                }

                                if ($upload) {
                                    //upload the image
                                    $imageResult = uploadExecute($file1_name, $file1_tmp_name, $path);

                                    if ($imageResult[0] == 1) {
                                        $PFPath = $imageResult[1];
                                    } else {
                                        $upload = false;
                                    }
                                }
                                else
                                {
                                    echo "Error deleting the old image";
                                }
                            }
                            else
                            {
                                $PFPath = $data[2];
                            }

                            if ($upload)
                            {
                                //Update to db
                                if (updateMentorProfile($ID, $name, $email, $language, $PFPath, $companyName, $phone))
                                {
                                    ?> <script> sendHeader('profile.php'); </script> <?php
                                }
                                else
                                {
                                    "Error uploading data";
                                }
                            }
                            else
                            {
                                echo " - Error - ";
                            }

                        }//End $check
                        else
                        {
                            echo " - Error - ";
                        }
                    }
				?>
				<br>
                </div>
				
                <div class="info2">
                    <form action="#" method="POST">
                        <h1>Change password</h1><br>
                        <input type="password" name="oldPassword" placeholder="Old password"> <br><br>
                        <input type="password" name="password" placeholder="New password"> <br>
                        <input type="password" name="password2" placeholder="Repeat password"> <br><br>
                        <input class="submit" type="submit" name="changePassword" value="Change Password">
                    </form>
                    <?php
						if (isset($_POST['changePassword']))
						{
							$passwordold = htmlentities(mysqli_real_escape_string($conn, $_POST['oldPassword']));
							$password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
							$password2 = htmlentities(mysqli_real_escape_string($conn, $_POST['password2']));
							if ($passwordold == "")
							{
								echo "The old password hasn't been entered";
							}
							else if ($password2 == "")
							{
								echo "The new password needs to be confirmed";
							}
							else if ($password != $password2)
							{
								echo "The passwords do not match";
							}
							else if (!(preg_match("#[A-Z]+#", $password) && preg_match("#[a-z]+#", $password) && preg_match("#[0-9]+#", $password)))
							{
								echo "The password should atleast contain one lowercase letter, one uppercase letter and one number";
							}
							else if (!(strlen($password) >= 8 && strlen($password) <= 60))
							{
								echo "The password should be between 8 and 60 characters";
							}
							else
							{
								updatePassword($ID, $passwordold, $password);
							}
						}
                    ?>
                </div>

            </div>

        </div>

    </div>
</Main>
</body>
</html>