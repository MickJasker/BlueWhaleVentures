<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Company');
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
	<body id="wrapper-admin-body">
		<header class="row wrapper-nav">
		<?php
        require "../nav_client.php"
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
			  <?php selectLanguage($ID); ?>
			</select> <br> 
			<?php if ($data[7] != "")
					{
						echo '<img src="../../'.$data[6].'" alt="Profile picture" height="100px">';
					}
			?>
			Upload company logo: <input type="file" name="file2" id="file2"> 
			<input type="text" name="companyName" placeholder="Company name" value="<?php echo $data[4]; ?>"> <br>
			<textarea name="companyDescription" placeholder="Company description"> <?php echo $data[5]; ?>	</textarea><br>
			<input type="text" name="phone" placeholder="Company phone number" value="<?php echo $data[7]; ?>"> <br>
			<input type="text" name="address" placeholder="Company address" value="<?php echo $data[8]; ?>"> <br>
			<select name="branch">
				<option value="<?php echo $data[9]; ?>"><?php echo $data[9]; ?></option>
				<option value="Agriculture, forestry and fisheries">Agriculture, forestry and fisheries</option>
				<option value="Mining of minerals">Mining of minerals</option>
				<option value="Industry">Industry</option>
				<option value="Production and distribution of and trade in electricity, natural gas, steam and chilled air">Production and distribution of and trade in electricity, natural gas, steam and chilled air</option>
				<option value="Winning and distribution of water, waste and wastewater management and remediation">Winning and distribution of water, waste and wastewater management and remediation</option>
				<option value="Construction industry">Construction industry</option>
				<option value="Wholesale and retail, repair of cars">Wholesale and retail, repair of cars</option>
				<option value="Transport and storage">Transport and storage</option>
				<option value="Accommodation, meal and beverage delivery">Accommodation, meal and beverage delivery</option>
				<option value="Information and communication">Information and communication</option>
				<option value="Financial Institutions">Financial Institutions</option>
				<option value="Rental of and trading in real estate">Rental of and trading in real estate</option>
				<option value="Consultancy, research and other specialist business services">Consultancy, research and other specialist business services</option>
				<option value="Rental of movable property and other business services">Rental of movable property and other business services</option>
				<option value="Public administration, public services and compulsory social insurance">Public administration, public services and compulsory social insurance</option>
				<option value="Education">Education</option>
				<option value="Health and welfare">Health and welfare</option>
				<option value="Culture, sports and recreation">Culture, sports and recreation</option>
				<option value="Other services">Other services</option>
				<option value="Extraterritorial organizations and bodies">Extraterritorial organizations and bodies</option>
			</select>
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
					$companyName = secure($_POST['companyName']);			
					$companyDescription = secure($_POST['companyDescription']);
					$phone = secure($_POST['phone']);
					$address = secure($_POST['address']);
					$branch = secure($_POST['branch']);
					
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
					else if (!(strlen($companyName) >= 1 && strlen($companyName) <= 50))
					{
						$check = false;
						echo "The company name should be between 1 and 32 characters";
					}
					else if (!(strlen($companyDescription) >= 1 && strlen($companyDescription) <= 1000))
					{
						$check = false;
						echo "The company name should be between 1 and 1000 characters";
					}
					else if (!(strlen($phone) >= 6 && strlen($phone) <= 20 && is_numeric($phone)))
					{
						$check = false;
						echo "The phone number is empty or not correct";
					}
					else if (!(strlen($address) >= 4 && strlen($address) <= 100))
					{
						$check = false;
						echo "The adress is empty or not correct";
					}
					else if  ($branch == "")
					{
						$check = false;
						echo "No branch has been choosen";
					}
					
					
					if ($check)
					{
						//Profile picture upload
						$PFPath = "";
						if (!empty($_FILES['file1']['name'])) 
						{
							$type = "img";
							$path = "../../Client_Portal/Uploads/profilePicture/";
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