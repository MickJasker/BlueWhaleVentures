<?php
require '../../Main/Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title> Create a new design sheet </title>
</head>
	<body id="wrapper-admin">
		<Main>
		<h1> New experiment </h1>
			<form method="POST" action="#">
				Title: <input type="text" name="title" value="Title"> <br>
				Thumbnail: <input type="file" name="fileToUpload" id="fileToUpload"> <br>
				Description: <br>
				<textarea name="input'.$i.'" type="text" placeholder="Description"></textarea> <br>
				<input name="submitExperiment" type="submit" value="Enter" >
			</form>
			<?php
				if (isset($_POST['submitExperiment']))
				{
					$title = htmlentities(mysqli_real_escape_string($conn, $_POST['title']));
					$description = htmlentities(mysqli_real_escape_string($conn, $_POST['description']));
					
					//Image check
					$type = "img"; $path = "../Uploads/ExperimentThumbnail"; $file1_name = $_FILES['fileToUpload']['name']; $file1_tmp_name = $_FILES['fileToUpload']['tmp_name']; $file1_size = $_FILES['fileToUpload']['size'];
					
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
						$imgResult = uploadExecute($file_name, $file_tmp_name, $target_dir);
						if ($imgResult[0] == 1)
						{
							$imagepath = $result[1]; 
						}
						else
						{
							$upload = false;
						}
						
						if ($upload)
						{
							//upload data to the database
							if ($id = createExperiment($title, $description, $imagepath, $companyid))
							{
								//header("Location: edit.php?id=" . $id . "&type=first");
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
		</Main>
	</body>
</html>