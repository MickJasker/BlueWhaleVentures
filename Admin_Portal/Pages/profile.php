<?php
require '../../Main/Includes/PHP/functions.php';
CheckSession("Admin");
?>
<!DOCTYPE html>
<html>
<head>
    <title> Admin Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
	<body id="wrapper-admin-body">
		<header class="row wrapper-nav">
			<?php require "../nav_nosearchadmin.php"; ?>
		</header>
		<Main id="wrapper-admin">
		<?php
			$ID = $_SESSION["UserID"];
			$data = getAdminProfile($ID);
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
			  <?php selectLanguage($ID); ?>
			</select> <br>
			<input type="submit" name="submit" value="Save">
		</form> 
		<hr>
		<form action="#" method="POST">
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
					
					if ($check)
					{
						//Profile picture upload
						$PFPath = "";
						if (!empty($_FILES['file1']['name'])) 
						{
							$type = "img";
							$path = "../../Admin_Portal/Uploads/profilePicture/";
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
							if (updateAdminProfile($ID, $name, $email, $language, $PFPath))
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
		</Main>
	</body>
</html>