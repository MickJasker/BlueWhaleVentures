<?php
//This file contains all the functions preparing the database queries. 
//Each function will prepare an sql-string, and an optional array of variables, 
//which will be sent to db_functions.
 
require "connect.php";
require "dbFunctions.php";

//Gets the email from Login and RegisterKey, if it doesn't exist, return true
function checkEmailAvailability($email)
{
	$sql = "SELECT Email FROM Login WHERE Email = '$email'";

	if (query($sql))
	{
		return false;
	}
	else
	{
		$sql = "SELECT Email FROM RegisterKey WHERE Email = '$email'";

		if (query($sql))
		{
			return false;
		}
	}

	return true;
}

//Get email and name from key, and check if it exists
function getKey($key)
{
	$sql = "SELECT Email, Name FROM RegisterKey WHERE `KeyCode` = '$key'";
	if($data = query($sql))
	{
		$db_data = array("true");
		while($row = $data->fetch_assoc())
		{
			$mail = $row["Email"];
			$name = $row["Name"];
			array_push($db_data, $mail, $name);
		}
		return $db_data;
	}
	else
	{
		echo "The key doesn't exist";
		return false;
	}
}

//Check if the key exists and delete the key from the database
function checkKey($key)
{
	$sql = "SELECT ID, RoleID FROM RegisterKey WHERE `KeyCode` = '$key'";
	if($data = query($sql))
	{
		while($row = $data->fetch_assoc())
		{
			$id = $row["ID"];
			$role = $row["RoleID"];
		}
		
		$sql = "DELETE FROM `RegisterKey` WHERE ID = '$id'";
		if($data = query($sql))
		{
			return $role;
		}
	}
	else
	{
		echo "The key doesn't exist";
		return false;
	}
}

//Creates an account
function createAccount($role, $user_name, $company_mail, $password)
{
	//Insert new user account
	$password = password_hash($password, PASSWORD_DEFAULT);
	$sql = "INSERT INTO `User`(`RoleID`,`Language`, `Name`, `Locked`) VALUES ('$role','English','$user_name', '0')";
	
	if (query($sql))
	{
		//Select ID from new user
		$sql = "SELECT ID FROM User WHERE Name = '$user_name'";

		if($data = query($sql))
		{	
			while($row = $data->fetch_assoc())
			{
				$id = $row["ID"];
			}
			
			if ($id != "")
			{
				//create new login record
				$sql = "INSERT INTO `Login`(`UserID`, `Email`, `Password`) VALUES ('$id', '$company_mail', '$password')";
				if (query($sql))
				{
					return insertRoleInfo($id);
				}
			}
		}
	}

	return false;
}

function insertRoleInfo($userID)
{
	$role = selectRole($userID);

	if($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		if ($row["Name"] == "Company")
		{
			return insertCompany($userID);
		}

		if ($row["Name"] == "Mentor")
		{
			return insertMentor($userID);
		}

		//If admin, do nothing, admin currently has no extra information
	}
}

function insertCompany($userID)
{
	$sql = "INSERT INTO Company (UserID) VALUES ('$userID')";

	return query($sql);
}

function insertMentor($userID)
{
	$sql = "INSERT INTO Mentor (UserID) VALUES ('$userID')";

	return query($sql);
}

function updateCompany($UserID, $Name, $Description, $Logo, $Email, $Phone, $Address, $Branch)
{
	$sql = "UPDATE Company SET 
	Name = '$Name', 
	Description = '$Description', 
	Logo = '$Logo', 
	Email = '$Email',
	Phone = '$Phone', 
	Address = '$Address',
	Branch = '$Branch' 
	WHERE UserID = '$UserID'";

	return query($sql);
}

function updateMentor($UserID, $CompanyName, $Phone)
{
	$sql = "UPDATE Mentor SET 
	CompanyName = '$CompanyName',
	Phone = '$Phone'
	WHERE UserID = '$UserID'";

	return query($sql);
}

//Insert generated code in the database
function createCode($email, $name, $generatedkey, $activetime, $role)
{
	//Change role to roleID
	$RoleID = "";
	if ($role == "Admin")
	{
		$RoleID = "6";
	}
	else if ($role == "Mentor")
	{
		$RoleID = "7";
	}
	else if ($role == "Company")
	{
		$RoleID = "8";
	}
	
	//Insert in db
	$sql = "INSERT INTO `RegisterKey`(`RoleID`, `KeyCode`, `Email`, `Name`, `ActiveTime`) VALUES ('$RoleID','$generatedkey','$email','$name','$activetime')";
	if (query($sql))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//Selects logininfo from DB
function selectLoginInfo($email, $password)
{
	$sql = "SELECT UserID, Password FROM Login WHERE Email = '$email'";
		if($data = query($sql))
		{	
			while($row = $data->fetch_assoc())
			{
				$dbpassword = $row["Password"];
				
				//Check if the password is correct
				if (password_verify($password, $dbpassword) != 0)
				{
					$UserID = $row["UserID"];
					$sql = "SELECT RoleID FROM User WHERE ID = '$UserID'";
						if($data = query($sql))
						{	
							$db_data = array("true");
							while($row = $data->fetch_assoc())
							{
								$RoleID = $row["RoleID"];
								$Role = "";
								
								//Change roleID to role
								if ($RoleID == "6")
								{
									$Role = "Admin";
								}
								else if ($RoleID == "7")
								{
									$Role = "Mentor";
								}
								else if ($RoleID == "8")
								{
									$Role = "Company";
								}
			
								array_push($db_data, $Role, $UserID);
							}
							return $db_data;
						}
				}
				else 
				{
					// Password is not correct
					echo "The username and/or password 	are/is not correct";
					return false;
				}
			}
		}
		else
		{
			echo "The username and/or password 	are/is not correct";
			return false;
		}
}

//Selects all experiment textareas etc
function getDesignSheetForm($sheetType, $language)
{
	$sql = "SELECT s.title, s.description FROM Segment s INNER JOIN DesignSheet d ON  d.ID = s.DesignSheetID WHERE d.Type = '$sheetType' AND d.Language = '$language'";

		if($data = query($sql))
		{	
			echo '<form id="designSheetForm" method="POST" action="#">';
			
			$i = 0;
			while($row = $data->fetch_assoc())
			{
				echo '<h3>'.$row["title"].'</h3>';
				echo '<textarea name="input'.$i.'"  type="text" placeholder="'.$row["description"].'"></textarea><br>';
				$i++;
			}
			echo '<input name="submitDesignsheet" type="submit" value="Enter" >';
			echo '</form>';
		}
		else
		{
			echo "Error retrieving experimentdata";
			return false;
		}
}

//Selects all experiment textareas etc
function getDesignSheetData($ExperimentID, $sheetType, $Language)
{
	$sql = "SELECT SegmentID, Text  FROM `Answer` WHERE ExperimentID = '$ExperimentID' ORDER BY SegmentID";
	if($data1 = query($sql))
	{	
		echo '<form method="POST" action="#">';
		$i = 0;
		while($row1 = $data1->fetch_assoc())
		{
			$id = $row1["SegmentID"];

			$sql = "SELECT s.title, s.description FROM Segment s
			INNER JOIN DesignSheet d ON d.ID = s.DesignSheetID 
			WHERE d.Type = '$sheetType' AND s.id = '$id'";

			if($data2 = query($sql))
			{
				$row2 = mysqli_fetch_array($data2,MYSQLI_ASSOC);
				echo '<h3>'.$row2["title"].'</h3>';
				echo '<textarea disabled class="textarea1" name="input'.$i.'"  type="text" placeholder="'.$row2["description"].'">'.$row1["Text"].'</textarea>';
				$i++;
			}
			else
			{
				echo "Error retrieving experimentdata";
				return false;
			}
		}
		echo '<input type="hidden" name="submitDesignsheet" value="Enter" id="submit1">';
		echo '</form>';
	}
	else
	{
		echo "Error retrieving experimentdata";
		return false;
	}
}

function createExperiment($title, $description, $imagepath, $companyid)
{
	$sql = "INSERT INTO `Experiment`(`CompanyID`, `Title`, `Thumbnail`, `Description`, `Progress`, `Completed`, `Reviewed`, `ReviewScore`) VALUES ('$companyid','$title','$imagepath','$description',0,0,0,0)";
	if (query($sql))
	{
		$sql = "SELECT ID FROM Experiment WHERE CompanyID = '$companyid' AND title = '$title' AND description = '$description' ORDER BY ID ASC";
		if($data = query($sql))
		{	
			
			while($row = $data->fetch_assoc())
			{
				$experimentId = $row["ID"];
			}
			return $experimentId;
		}
		else 
		{
			return false;
		}
		
	}
	else
	{
		return false;
	}
}

//Keep log on inlog
function loginlog($UserID, $state)
{
	//Current date displayed like: monday-01-01-17
	$date = date("l-d-m-y");
	
	//Current time displayed like: 03-15-45-pm 
	$time = date("h-i-s-a");
	
	//ip adress from the user
	$ip = $_SERVER['REMOTE_ADDR'];
	
	//Host name ip
	$host_name = Detect::ipHostname(); 
	
	//provider
	$organisation = Detect::ipOrg(); 
	
	//device type : computer or mobile etc
	$device_type = Detect::deviceType();
	
	//operating system device
	$operating_system = Detect::os(); 
	
	//browser
	$browser = Detect::browser(); 
	
	//brand of mobile device
	$brand = Detect::brand(); 
	
	//country
	$location = Detect::ipCountry(); 
	
	$sql = "INSERT INTO `Log`(`UserID`, `Date`, `Time`, `State`, `IP`, `HostName`, `Organisation`, `DeviceType`, `OperatingSystem`, `Browser`, `Brand`, `Location`) 
	VALUES ('$UserID', '$date', '$time', '$state', '$ip', '$host_name', '$organisation', '$device_type', '$operating_system', '$browser', '$brand', '$location')";
	query($sql);
}

function selectUser($Email)
{
	$sql = "SELECT ID FROM Login
	WHERE Email = '$Email'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row['ID'];
	}
}

function selectRole($ID)
{
	$sql = "SELECT r.Name FROM Role r
	INNER JOIN User u ON u.roleID = r.ID
	WHERE u.ID = '$ID'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row['Name'];
	}
}

function selectUserName($Email)
{
	$ID = selectUser($Email);

	$sql = "SELECT u.ID, u.Name FROM Role r 
	INNER JOIN User u ON  u.RoleID = r.ID
	INNER JOIN Company c ON c.UserID = 
	WHERE u.ID = '$ID'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row['Name'];
	}
}

function selectCompanyName($UserID)
{
	$sql = "SELECT c.Name FROM Company c
	INNER JOIN User u ON u.ID = c.UserID
	WHERE u.ID = '$UserID'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row['Name'];
	}
}

function selectCompanyID($UserID)
{
	$sql = "SELECT c.ID FROM Company c
	INNER JOIN User u ON u.ID = c.UserID
	WHERE u.ID = '$UserID'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row['ID'];
	}
}

function selectUserID($Email)
{
	$sql = "SELECT u.ID FROM User u
	INNER JOIN Login l ON l.UserID = u.ID
	WHERE l.Email = '$Email'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row['ID'];
	}
}

function selectUserLanguage($ID)
{
	$sql = "SELECT Language FROM User WHERE ID = '$ID'";
	
	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row['Language'];
	}
}


//Admin portal blokken
function getCompanyBlockInfo()
{
    $sql = "SELECT ID, Name, Logo, Branch FROM Company";

    if($data = Query($sql)) 
    {
        while ($row = $data->fetch_assoc()) 
        {
            $ID = $row["ID"];
            $Logo = $row["Logo"];
            $Name = $row["Name"];
            $Branch = $row["Branch"];

            ?>

            <li id="Block" class="<?php echo $Branch;?> col-lg-4">
                <a href="../../Admin_Portal/Pages/clientProfile.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                            <img src="../../<?php echo $Logo ?>" alt="Company Logo">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Name ?> </h1>
                    </div>
                </a>
            </li>

            <?php
        }
    }
}

//Get experiment info
function getExperiment($id)
{	
	$header = "designSheet.php";
	$header = "designSheet.php";
	$name = "";
	
	$sql = "SELECT Preparation, Conclusion FROM Pitch WHERE ExperimentID = '$id'";
	if ($data = query($sql))
	{
		while($row = $data->fetch_assoc())
		{
			if ($row["Preparation"] == "")
			{
				$name = "Add a pitch";
				$header = "newPitch.php";
			}
			else if ($row["Conclusion"] == "")
			{
				$name = "Add the conclusion";
				$header = "pitch.php";
			}
			else
			{
				$name = "View the results";
				$header = "pitch.php";
			}
		}
	}
	
	
	$questionaire = "0";

	$sql = "SELECT ID FROM Questionaire WHERE ExperimentID = '$id'";
	if ($data = query($sql))
	{
		$questionaireID = "";
		$name = "Add an interview";
		$header = "newInterview.php";
		while($row = $data->fetch_assoc())
		{
				$questionaireID = $row["ID"];
		}
		
		$sql = "SELECT `Question` FROM `Question` WHERE `QuestionaireID` = '$questionaireID'";
		if ($data2 = query($sql))
		{
			$name = "Interview";
			$header = "Interview.php";
		}
	}
	
	
	
	$sql = "SELECT Explanation1, Explanation2 FROM Prototype WHERE ExperimentID = '$id'";
	if ($data = query($sql))
	{
		while($row = $data->fetch_assoc())
		{
			if ($row["Explanation1"] == "")
			{
				$name = "Add a prototype";
				$header = "newPrototype.php";
			}
			else if ($row["Explanation2"] == "")
			{
				$name = "Add the prototype result";
				$header = "prototype.php";
			}
			else
			{
				$name = "View the results";
				$header = "prototype.php";
			}
		}
	}
	
	$sql = "SELECT `CompanyID`, `Title`, `Description`, `Progress`, `Reviewed`, `ReviewScore` FROM `Experiment` WHERE id = '$id'";
	if($data = query($sql))
	{
		while($row = $data->fetch_assoc())
		{
			$header = $header . "?experimentID=" . $id;
			//echo $row["Title"];
			echo '<h1>' . $row["Title"] . '</h1>';
			echo '<p>' . $row["Description"] .  '</p>';
			echo '<p> Progress: ' . $row["Progress"] . '</p>';
			echo '<p> Reviewscore: ' . $row["ReviewScore"] . '</p>';
			echo '<a href="designSheet.php?experimentID='.$id.'"><button> Design sheet </button></a>';
			echo '<a href="'.$header.'"><button> '.$name.' </button></a>';
			echo '<a href=""><button> Results </button></a>';
			echo '<a href="resultSheet.php?experimentid='.$_GET["id"].'"><button> Results sheet </button> </a>';
		}
	}
	else
	{
		return false;
	}
}

//Admin portal blokken
function getMentorBlockInfo()
{
    $sql = "SELECT u.ID, u.Name, u.ProfilePicture FROM User u
    INNER JOIN Role r ON r.ID = u.RoleID
    WHERE r.Name = 'Mentor'";

    if($data = Query($sql)) 
    {
        while ($row = $data->fetch_assoc()) 
        {
            $ID = $row["ID"];
            $ProfilePicture = $row["ProfilePicture"];
            $Name = $row["Name"];

            ?>

            <li id="Block" class="col-lg-4">
                <a href="../../../Admin_Portal/Pages/mentorProfile.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                            <img src="../../<?php echo $ProfilePicture; ?>" alt="Mentor Profile">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Name ?> </h1>
                    </div>
                </a>
            </li>

            <?php
        }
    }
}

//Client Portal Experiment blokken
function getExperimentBlockInfo($UserID)
{
    $sql = "SELECT e.ID, e.CompanyID, e.Title, e.Thumbnail, e.Completed FROM Experiment e 
            INNER JOIN Company c ON c.ID = e.CompanyID
            INNER JOIN User u ON u.ID = c.UserID
            WHERE u.ID = '$UserID'";

    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
            $ID = $row["ID"];
            $Title = $row["Title"];
            $Thumbnail = $row["Thumbnail"];

            // Nodig voor frontend, als iets klaar is wordt het grijs
            $Completed = $row["Completed"];

            ?>

            <li id="Block" class="col-lg-4">
                <a href="../../Client_Portal/Pages/experiment.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                        <img src="<?php echo $Thumbnail ?>" alt="Mentor Profile">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Title ?> </h1>
                    </div>
                </a>
            </li>

            <?php
        }
    }
}

//Client Portal Expirement blokken
function getMentorAssignedBlockInfo($UserID)
{
    $sql = "SELECT c.ID, c.Name, c.Logo FROM Company c 
            INNER JOIN Mentor_Company mc ON c.ID = mc.CompanyID
            INNER JOIN Mentor m ON m.ID = mc.MentorID
            INNER JOIN User u on u.ID = m.UserID
            WHERE u.ID = '$UserID'";

    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
            $ID = $row["ID"];
            $Name = $row["Name"];
            $Logo = $row["Logo"];

            ?>

            <li id="Block" class="col-lg-4">
                <a href="../../../Client_Portal/Pages/experiment.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                        <img src="../../<?php echo $Logo ?>" alt="Mentor Profile">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Name ?> </h1>
                    </div>
                </a>
            </li>

            <?php
        }
    }
}

function selectCompanyMentors($CompanyID)
{
	$sql = "SELECT m.ID, u.Name, u.ProfilePicture FROM Mentor m
	INNER JOIN User u ON u.ID = m.UserID
	INNER JOIN Mentor_Company mc ON mc.MentorID = m.ID
	INNER JOIN Company c ON c.ID = mc.CompanyID
	Where c.ID = '$CompanyID'";

	?>
	<section id="BottomCol">
	<?php

	if($data = Query($sql)) 
    {
    	while ($row = $data->fetch_assoc())
    	{
    		?>
			<div class="mentor-preview col-md-3">
				<a href="../../Admin_Portal/Pages/mentorProfile.php?id=<?php echo $row['ID'] ?>">
					<img src="../../<?php echo $row['ProfilePicture']; ?>" alt="Mentor Profile">
					<h4> <?php echo $row['Name'] ?> </h4>
				</a>
			</div>
			<?php
    	}
    }
    else
    {
    	echo "<br> No mentors assigned";
    }

	?>
	</section>
	<?php    
}

function selectCompanyInfo($CompanyID)
{
	$sql = "SELECT c.Name, c.Logo, c.Description, c.Email, c.Phone, c.Address FROM Company c
	WHERE c.ID = '$CompanyID'";

	if($data = Query($sql)) 
    {
    	$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
    	?>

    	<section class="TempColumn">
    		<div class="TempColLogo">
    			<img src="../../<?php echo $row['Logo']; ?>" alt="Company Logo">
    		</div>
			<div class="TempColDescription">
				<h1> <?php echo $row['Description']; ?> </h1>
			</div>
		</section>

		<section class="TempColumn">
			<div class="Temptable">
				<table>
					<tr>
						<th>Phone: </th>
						<td><?php echo $row["Phone"]; ?></td>
					</tr>
					<tr>
						<th>Email: </th>
						<td><?php echo $row["Email"]; ?></td>
					</tr>
					<tr>
						<th>Address: </th>
						<td><?php echo $row["Address"]; ?></td>
					</tr>
				</table>
		</section>
		<?php
    }
}

function insertExperiment($CompanyID, $Title, $Thumbnail, $Description)
{
	$sql = "INSERT INTO Experiment(CompanyID, Title, Thumbnail, Description, Completed) VALUES ('$CompanyID', '$Title', '$Thumbnail', '$Description', 0)";

	$data = Query($sql);
	return $data;
}


function insertQuestion($QuestionPost, $ExecutionID)
{
    foreach ($QuestionPost AS $ID => $Question) 
    {
		$sql = "SELECT Question FROM Question WHERE ID = '$ID'";

		if(Query($sql))
		{
			if($Question != "Save")
			{
                $sql = "UPDATE Question SET Question = '$Question' WHERE ID = '$ID'";
                Query($sql);
			}
		}
		else
		{
			if($Question != "Save")
			{
                $sql = "INSERT INTO Question(QuestionaireID, Question) VALUES ($ExecutionID,'$Question')";
                Query($sql);
			}
		}
    }
}


function SelectQuestion($ExecutionID) 
{
    $sql = "SELECT ID, Question FROM Question
            WHERE QuestionaireID = $ExecutionID";

    $i = 0;
    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
            $i++;
            $QuestionID = $row["ID"];
            $Question = $row["Question"];

            ?>

            <textarea id="question<?php echo $i?>" name="<?php echo $QuestionID?>"><?php echo $Question?></textarea>

            <?php
        }
    }
    $i++;
    return $i;
}

function updateAdminProfile($ID, $AdminName, $AdminPic, $AdminLang)
{
	if(is_null($AdminPic))
	{
		$sql = "UPDATE User
		SET Name = '$AdminName', Language = '$AdminLang'
		WHERE ID = '$ID'";
	}
	else
	{
		$sql = "UPDATE User 
		SET Name = '$AdminName', ProfilePicture = '$AdminPic', Language = '$AdminLang'
		WHERE ID = '$ID'";
	}
}

function selectAdminProfile($ID)
{
	$sql = "SELECT Name, ProfilePicture, Language From User
	WHERE ID = '$ID'";

	if($data = Query($sql)) 
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		?>
		<form method="POST" action="#">
			<p>Name:</p>
            <input type="text" placeholder="Name" name="adminName" value="<?php echo $row['Name'];?>"><br>

            <p>Profile Picture:</p>
            <img src="../../<?php echo $row['ProfilePicture'] ?>" alt="Profile picture"><br>
            <input type="file" placeholder="Profile picture" name="adminPic"><br>

            <p>Language:</p>
            <select>
            	<option 
            	<?php if($row['Language'] == "English") 
            		{
            			echo 'selected';
            		} ?> 
            	value="English">English</option>
            	<option 
            	<?php if($row['Language'] == "Nederlands") 
            		{
            			echo 'selected';
            		} ?> 
            	value="Nederlands">Nederlands</option>
            </select>

        	<input type="submit" placeholder="Save changes" name="submit">
		</form>
		<?php
	}
}

function insertDesignSheet($answerPost, $sheetType, $Language, $experimentID)
{
	global $conn;

	//Select input field data, and put it in answerArray
	$answerArray = array();
	foreach ($answerPost AS $postID => $answer)
	{
		if ($postID != "submitDesignsheet")
		{
			$value = htmlentities(mysqli_real_escape_string($conn, $answer));
			array_push($answerArray, $value);
		}
	}

	//Select the design
	$sql = "SELECT s.ID FROM Segment s
	INNER JOIN DesignSheet d ON s.DesignSheetID = d.ID
	WHERE d.Type = '$sheetType' AND d.Language = '$Language'";

	if($data = Query($sql))
	{
		$counter = 0;
		//Foreach segment, add a value from answerArray
		while ($row = $data->fetch_assoc())
		{
			$segment = $row["ID"];
			$answer = $answerArray[$counter];

			$sql = "INSERT INTO Answer (SegmentID, ExperimentID, `Text`) Values ('$segment', '$experimentID', '$answer')";
			Query($sql);

			$counter++;
		}
	}
}

function updateDesignSheet($answerPost, $sheetType, $Language, $experimentID)
{
	global $conn;

	//Select input field data, and put it in answerArray
	$answerArray = array();
	foreach ($answerPost AS $postID => $answer)
	{
		if ($postID != "submitDesignsheet")
		{
			$value = htmlentities(mysqli_real_escape_string($conn, $answer));
			array_push($answerArray, $value);
		}
	}

	//Select the design
	$sql = "SELECT s.ID FROM Segment s
	INNER JOIN DesignSheet d ON s.DesignSheetID = d.ID
	WHERE d.Type = '$sheetType' AND d.Language = '$Language'";

	if($data = Query($sql))
	{
		$counter = 0;
		//Foreach segment, add a value from answerArray
		while ($row = $data->fetch_assoc())
		{
			$segment = $row["ID"];
			$answer = $answerArray[$counter];

			$sql = "UPDATE Answer SET `Text` = '$answer' WHERE SegmentID = '$segment' AND experimentID = '$experimentID'";
			Query($sql);

			$counter++;
		}
	}
}

function sendExecution($ExecutionPost, $ExperimentID)
{
	global $conn;

    foreach ($ExecutionPost AS $ID => $Execution) {
        if ($ID == "interview") {
            $sql = "INSERT INTO Questionaire(ID, ExperimentID) VALUES (DEFAULT, '$ExperimentID')";
            Query($sql);

            $_SESSION['insertedID'] = mysqli_insert_id($conn);
            header('Location: ../../Client_Portal/Pages/newInterview.php');

        }

        if ($ID == "pitch") {
            $sql = "INSERT INTO Pitch(ID, ExperimentID) VALUES (DEFAULT, '$ExperimentID')";
            Query($sql);

            $_SESSION['insertedID'] = mysqli_insert_id($conn);
            header('Location: ../../Client_Portal/Pages/newPitch.php');


        }

        if ($ID == "prototype") {
            $sql = "INSERT INTO Prototype(ID, ExperimentID) VALUES (DEFAULT, '$ExperimentID')";
            Query($sql);

            $_SESSION['insertedID'] = mysqli_insert_id($conn);
            header('Location: ../../Client_Portal/Pages/newPrototype.php?experimentID=' . $ExperimentID);


        }
    }
}

function insertPitch($Text, $PitchID) {

    $sql = "UPDATE Pitch SET Preparation = '$Text' WHERE ID = '$PitchID'";
    Query($sql);

}

function insertPrototype($ImagePath, $Explain, $ExperimentID) {

    $sql = "UPDATE Prototype SET Media1 = '$ImagePath', Explanation1 = '$Explain' WHERE ExperimentID = '$ExperimentID'";


    if (Query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }

}

function updatePitch($VideoPath, $Preparation, $Conclusion) {

    $sql = "UPDATE Pitch SET Preparation = '$Preparation', Media = '$VideoPath', Conclusion = '$Conclusion' WHERE ExperimentID = 1";
    if (Query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }

}

function selectPitch($ExperimentID)
{
    $sql = "SELECT Preparation, Media, Conclusion FROM Pitch WHERE ExperimentID = '$ExperimentID'";

    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
            $Preparation = $row["Preparation"];
            $Media = $row["Media"];
            $Conclusion = $row["Conclusion"];

            ?>

            Preparation: <br/>
            <textarea disabled class="textarea1" name="preparationText" typeplaceholder="Prepare for your pitch"><?php echo $Preparation?></textarea>

            <input id="file1" type="hidden" name="file1" id="fileToUpload">


            <?php

            if ($Media != "") {

                ?>

                <video controls>
                    <source src="<?php echo $Media ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video> <br/>

                <?php

            }
            else {

            }

            ?>

            Conclusion: <br/>
            <textarea disabled class="textarea1" name="conclusionText" placeholder="Conclusion of your pitch"><?php echo $Conclusion?></textarea> <br/>
            <input id="submit1" type="hidden" name="save" value="Save">

            <?php
        }
    }
    return $Media;
}

function getClientProfile($ID)
{
	$results = array();	
	$succes = 0;
	
	$sql = "SELECT Language, Name, ProfilePicture FROM User WHERE ID = '$ID'";
    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
			array_push($results, $row["Language"], $row["Name"], $row["ProfilePicture"]);
			$succes = $succes + 1;
		}
	}
	
	$sql = "SELECT Email, Password FROM Login WHERE UserID = '$ID'";
    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
			array_push($results, $row["Email"], $row["Password"]);
			$succes = $succes + 1;
		}
	}
	
	$sql = "SELECT Name, Description, Logo, Phone, Address, Branch FROM Company WHERE UserID = '$ID'";
    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
			array_push($results, $row["Name"], $row["Description"], $row["Logo"], $row["Phone"], $row["Address"], $row["Branch"]);
			$succes = $succes + 1;
		}
	}
	
	if ($succes == 3)
	{
		return $results;
	}
	return false;
}

function updateClientProfile($ID, $name, $email, $language, $companyName, $companyDescription, $phone, $address, $branch, $PFPath, $LPath)
{
	$sql = "UPDATE `User` SET `Language`='$language', `Name`='$name', `ProfilePicture`='$PFPath' WHERE ID = '$ID'";
	if(Query($sql))
    {
		$sql = "UPDATE `Login` SET `Email`='$email' WHERE UserID = '$ID'";
		if(Query($sql))
		{
			$sql = "UPDATE `Company` SET `Name`='$companyName',`Description`='$companyDescription',`Logo`='$LPath',`Phone`='$phone',`Address`='$address',`Branch`='$branch' WHERE UserID = '$ID'";
			if(Query($sql))
			{
				return true;
			}
		}
	}
	return false;
}

function selectLanguage()
{
	$sql = "SELECT DISTINCT Language FROM User";
    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
			echo '<option value="'.$row["Language"].'">'.$row["Language"].'</option>';
		}
	}
}

function updatePassword($ID, $passwordold, $password)
{
	$sql = "SELECT Password FROM Login WHERE `UserID` = '$ID'";
		if($data = query($sql))
		{	
			while($row = $data->fetch_assoc())
			{
				$dbpassword = $row["Password"];
				
				//Check if the password is correct
				if (password_verify($passwordold, $dbpassword) != 0)
				{
					$password = password_hash($password, PASSWORD_DEFAULT);
					$sql = "UPDATE `Login` SET `Password`='$password' WHERE `UserID` = '$ID'";
					if(Query($sql))
					{
						return true;
					}
				}
				else
				{
					echo "The old password entered is not correct";
				}
			}
		}
	return false;
}

function selectPrototype($ExperimentID) {

    $OldArray = array();

    $sql = "SELECT Media1, Explanation1, Media2, Explanation2 FROM Prototype WHERE ExperimentID = '$ExperimentID'";

    if($data = Query($sql))
    {
        while ($row = $data->fetch_assoc())
        {
            $Media1 = $row["Media1"];
            $Explanation1 = $row["Explanation1"];
            $Media2 = $row["Media2"];
            $Explanation2 = $row["Explanation2"];


            ?>

            <input id="file2" type="hidden" name="file1" id="fileToUpload">

            <?php

            if ($Media1 != "") {
                array_push($OldArray,$Media1);

                ?>


                <img src="<?php echo $Media1 ?>" alt="Prototype 1">

                <?php

            }
            ?>


            <textarea disabled class="textarea1" name="explanation1" placeholder="Explain your prototype."><?php echo $Explanation1?></textarea> <br/>

            <input id="file3" type="hidden" name="file2" id="fileToUpload2">

            <?php

            if ($Media2 != "") {
                array_push($OldArray,$Media2);

                ?>


                <img src="<?php echo $Media2 ?>" alt="Prototype 2">

                <?php

            }
            ?>

            <textarea disabled class="textarea1" name="explanation2" placeholder="Explain your prototype."><?php echo $Explanation2?></textarea> <br/>
            <input id="submit1" type="hidden" name="save" value="Save">

        <?php
        }
    }
    return $OldArray;
}

function updatePrototype($ExperimentID, $Media1, $Explanation1, $Media2, $Explanation2) {

    $sql = "UPDATE Prototype SET Media1 = '$Media1', Explanation1 = '$Explanation1', Media2 = '$Media2', Explanation2 = '$Explanation2' WHERE ExperimentID = '$ExperimentID'";
    if (Query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function selectQuestions($ExperimentID) {

    $sql = "SELECT qu.ID, qu.Question FROM Question qu
            INNER JOIN Questionaire q ON q.ID = qu.QuestionaireID
            INNER JOIN Experiment e ON e.ID = q.ExperimentID
            WHERE e.ID = '$ExperimentID'";

    $i = 1;

    if($data = Query($sql)) {
        while ($row = $data->fetch_assoc()) {
            $ID = $row["ID"];
            $Question = $row["Question"];

            ?>

            <div id="questionDiv">
                <div id="question<?php echo $ID?>">
                    <textarea id="question" name="question<?php echo $ID?>"><?php echo $Question?></textarea>
                    <div id="answers">
                        <?php
                            $i  = selectAnswers($ID, $i);
                        ?>
                    </div>
                </div>
            </div>


            <?php
        }
    }
    return $i;
}

function selectAnswers($questionID, $i){

    $sql = "SELECT ID, Answer FROM Response WHERE QuestionID = '$questionID'";

    if ($data = Query($sql)) {
        while ($row = $data->fetch_assoc()) {
            $ID = $row["ID"];
            $Answer = $row["Answer"];
            ?>

            <textarea id="answer" name="answer<?php echo $ID ?>"><?php echo $Answer ?></textarea>

            <?php

            $i++;

        }
    }
    ?>

        <button type="button" onclick="addAnswer(<?php echo $questionID?>)">Add Answer</button>

    <?php
    return $i;
}

function insertAnswer($POSTData, $ExperimentID)
{


    $sql = "SELECT qu.QuestionaireID FROM Question qu
            INNER JOIN Questionaire q ON q.ID = qu.QuestionaireID
            INNER JOIN Experiment e ON e.ID = q.ExperimentID
            WHERE e.ID = '$ExperimentID'
            LIMIT 1";

    if ($data = Query($sql)) {
        while ($row = $data->fetch_assoc()) {

            $QuestionaireID = $row['QuestionaireID'];

        }

    } else {
        echo "Shits fucked yo";
    }

    foreach ($POSTData AS $Key => $Text) {

        if (strpos($Key, 'question') !== false) {

            $ID = substr($Key, 8);
            $sql = "SELECT ID FROM Question WHERE ID = '$ID'";

            if ($data = Query($sql)) {
                while ($row = $data->fetch_assoc()) {

                    $QuestionID = $row['ID'];

                }

                if (Query($sql)) {
                    $sql = "UPDATE Question SET Question = '$Text' WHERE ID = '$ID'";
                    Query($sql);
                } else {
                    $sql = "INSERT INTO Question(QuestionaireID, Question) VALUES ('$QuestionaireID','$Text')";
                    Query($sql);
                }
            }
        }

        elseif (strpos($Key, 'answer') !== false) {

            $ID = substr($Key, 6);
            $sql = "SELECT ID FROM Response WHERE ID = '$ID'";

            if (Query($sql)) {
                $sql = "UPDATE Response SET Answer = '$Text' WHERE ID = '$ID'";
                Query($sql);
            } else {
                $sql = "INSERT INTO Response(QuestionID, Answer) VALUES ('$QuestionID','$Text')";
                Query($sql);
            }

        }
    }

}

?>
