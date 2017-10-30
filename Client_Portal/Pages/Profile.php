<?php
require '../../Main/Includes/PHP/functions.php';
CheckSession("Client");
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
	<body id="wrapper-admin-body">
		<header class="row wrapper-nav">
		<?php
        require "../../Main/Includes/nav.php"
		?>
		</header>
		<Main id="wrapper-admin">
		<?php
			$ID = $_SESSION["UserID"];
			$data = getClientProfile($ID);
		?>
		
		<form id="form" action="#" method="POST" enctype="multipart/form-data">
			<?php if ($data[2] != "")
					{
						echo '<img src="'.$data[2].'" alt="Profile picture" height="100px">';
					}
			?>
			Upload profile picture: <input type="file" name="file1" id="file1"> 
			<input type="text" name="name" placeholder="Name" value="<?php echo $data[1]; ?>"> <br>
			<input type="text" name="email" placeholder="E-mail" value="<?php echo $data[3]; ?>"> <br>
			<select name="language">
			  <?php selectLanguage(); ?>
			</select> <br>
			<?php if ($data[7] != "")
					{
						echo '<img src="../../'.$data[7].'" alt="Profile picture" height="100px">';
					}
			?>
			Upload company logo: <input type="file" name="file2" id="file2"> 
			<input type="text" name="companyName" placeholder="Company name" value="<?php echo $data[5]; ?>"> <br>
			<textarea name="companyDescription" placeholder="Company description"> <?php echo $data[6]; ?>	</textarea><br>
			<input type="text" name="phone" placeholder="Company phone number" value="<?php echo $data[8]; ?>"> <br>
			<input type="text" name="address" placeholder="Company address" value="<?php echo $data[9]; ?>"> <br>
			<input type="text" name="branch" placeholder="Company branch" value="<?php echo $data[10]; ?>"> <br>
			<input type="submit" name="submit" value="Save">
		</form>
		<hr>
		<form>
			
			<input type="password" name="oldPassword" placeholder="Old password"> <br>
			<input type="password" name="password" placeholder="Password"> <br>
			<input type="password" name="password2" placeholder="Repeat password"> <br>
			<input type="submit" name="changePassword" value="Change Password">
		</form>
		<?php
		
		
				if (isset($_POST['submit']))
				{
					$name = secure($_POST['name']);
					$email = secure($_POST['email']);
					$language = secure($_POST['language']);	
					$companyName = secure($_POST['companyName']);			
					$companyDescription = secure($_POST['companyDescription']);
					$phone = secure($_POST['phone']);
					$address = secure($_POST['address']);
					$branch = secure($_POST['branch']);
					
					$upload = true;
					
					//Profile picture upload
					$PFPath = "";
					if (!empty($_FILES['file1']['name'])) 
					{
						$type = "img";
						$path = "../Uploads/profilePicture/";
						$file1_name = $_FILES['file1']['name'];
						$file1_tmp_name = $_FILES['file1']['tmp_name'];
						$file1_size = $_FILES['file1']['size'];
							
						if ($data[2] != "")
						{
							if (!unlink($data[2])) 
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
					
					//Logo upload
					$LPath = "";
					if (!empty($_FILES['file2']['name'])) 
					{
						$type = "img";
						$path2 = "Client_Portal/Uploads/profilePicture/";
						$file2_name = $_FILES['file2']['name'];
						$file2_tmp_name = $_FILES['file2']['tmp_name'];
						$file2_size = $_FILES['file2']['size'];
							
						if ($data[7] != "")
						{
							if (!unlink("../../".$data[7])) 
							{
                                echo "error deleting old image";
                                $upload = false;
							}
						}
						
						if ($upload) {
                            //upload the image
                            $imageResult = uploadExecute($file2_name, $file2_tmp_name, $path2);
                       
                            if ($imageResult[0] == 1) {
                                $LPath = $imageResult[1];
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
						$LPath = $data[7];
					}
					
					if ($upload)
					{
						//Update to db
						if (updateClientProfile($ID, $name, $email, $language, $companyName, $companyDescription, $phone, $address, $branch, $PFPath, $LPath))
						{
							header("Location: profile.php");
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
					
				}
				
				if (isset($_POST['changePassword']))
				{
					$passwordold = htmlentities(mysqli_real_escape_string($conn, $_POST['oldPassword']));
					$password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
					$password2 = htmlentities(mysqli_real_escape_string($conn, $_POST['password2']));
					//changepassword func
				}
			?>
		</Main>
	</body>
</html>