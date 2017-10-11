<?php
require "queries.php";
session_start();


//This functions generates an random key and sends an email to the user
function generate_key($email, $name, $role)
{
	if (checkEmailAvailability(@email))
	{
		//array with alphabet + numbers
		$numbers = range(chr(48),chr(57));
		$letters = range(chr(65),chr(90));
		$characters = array_merge($numbers, $letters);
				
		//Generate 6 random numbers
		$number = mt_rand(0, 35); $number2 = mt_rand(0, 35); $number3 = mt_rand(0, 35); 
		$number4 = mt_rand(0, 35); $number5 = mt_rand(0, 35); $number6 = mt_rand(0, 35);
				
		//Get characters from array with the random generated numbers
		$generatedkey = $characters[$number] . $characters[$number2] . $characters[$number3] . $characters[$number4] . $characters[$number5] . $characters[$number6];
						
		//Make url
		$url = "http://localhost/BW-Ventures/main/pages/createAccount.php"; //Put the url in here 
		$link = $url . "?key=" . $generatedkey;
		
		//Time + 31 days YYYY-MM-DD HH:MI:SS
		$activetime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +31 days"));
		
		//Insert the code in the db
		if (createCode($email, $name, $generatedkey, $activetime, $role))
		{	
			echo "gelukt";
			return true;
		}	
		else
		{
			return false;
		}
	}

	echo "Email is not available!";
}

function createSession($Email)
{
	$_SESSION["LoggedIn"] = true;
	$_SESSION["Role"] = selectRole($Email);
	$_SESSION["UserID"] = selectUserID($Email);
	$_SESSION["CompanyID"] = selectCompanyID($_SESSION["UserID"]);
	
	/*
	echo "Logged in: " . $_SESSION["LoggedIn"] . "<br>";	
	echo "Role: " . $_SESSION["Role"] . "<br>";
	echo "UserID: " . $_SESSION["UserID"] . "<br>";	
	echo "CompanyID: " . $_SESSION["CompanyID"];	
	*/
}


function checkSession($AllowedRole)
{
	if (!$_SESSION["LoggedIn"] || $_SESSION["Role"] != $AllowedRole)
	{
		return false;
	}

	return true;
}

function destroySession()
{
	unset($_SESSION["LoggedIn"]);
	unset($_SESSION["Role"]);
	unset($_SESSION["UserID"]);
	unset($_SESSION["CompanyID"]);
}

// Checks if the file is ready for upload
function uploadCheck($file_name, $file_tmp_name, $file_size, $type, $target_dir)
{
	$target_file = $target_dir . basename($file_name);
	$uploadok = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	if ($type == "img")
	{
		// Check if image file is a actual image or fake image
		if(getimagesize($file_tmp_name) === false) 
		{
		    echo "File is not an image.";
		    $uploadok = 0;
		} 
	}
	    
	// Check if file already exists
	if (file_exists($target_file)) 
	{
	    echo "Sorry, file already exists.";
	    $uploadok = 0;
	}
	
	// Check file size
	if ($file_size > 30000000) 
	{
	    echo "Sorry, your file is too large.";
	    $uploadok = 0;
	}
	
	if ($type == "img")
	{
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
		&& $imageFileType != "GIF") 
		{
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadok = 0;
		}
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadok == 0) 
	{
	    return false;
	} 
	else 
	{
		return true;
	}
}

// Uploads a file (Only upload)
function uploadExecute($file_name, $file_tmp_name, $target_dir)
{
	$target_file = $target_dir . basename($file_name);
	$uploadok = 1;
	
	if (move_uploaded_file($file_tmp_name, $target_file)) 
	    {
	        echo "The file ". basename($file_name). " has been uploaded.";
	    } 
	    else 
	    {
	        echo "Sorry, there was an error uploading your file.";
	        $uploadok = 0;
	    }
	//return if file is uploaded or not and filepath in array
	return array($uploadok, $target_file);
}

?>