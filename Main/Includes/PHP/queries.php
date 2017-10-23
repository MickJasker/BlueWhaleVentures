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
	$password = password_hash($password, PASSWORD_DEFAULT);
	$sql = "INSERT INTO `User`(`RoleID`,`Language`, `Name`, `Locked`) VALUES ('$role','English','$user_name', '0')";
	
	if (query($sql))
	{
		$sql = "SELECT ID FROM User WHERE Name = '$user_name'";
		if($data = query($sql))
		{	
			while($row = $data->fetch_assoc())
			{
				$id = $row["ID"];
			}
			
			if ($id != "")
			{
				$sql = "INSERT INTO `Login`(`UserID`, `Email`, `Password`) VALUES ('$id', '$company_mail', '$password')";
				if (query($sql))
				{
					return true;
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
function getDesignSheetForm($sheetType = "Experiment", $Language = "English")
{
	//$sql = "SELECT title, description FROM Segment WHERE Type = '$sheetType' AND Language = '$Language'"; //Ask Sven to work
	$sql = "SELECT title, description FROM Segment WHERE `DesignSheetID` = '1'"; //Temp query
		if($data = query($sql))
		{	
			echo '<form method="POST" action="#">';
			
			$i = 0;
			while($row = $data->fetch_assoc())
			{
				echo '<h3>'.$row["title"].'</h3>';
				echo '<textarea name="input'.$i.'"  type="text" placeholder="'.$row["description"].'"></textarea>';
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
		return $row;
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
		return $row;
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
    $sql = "SELECT ID, Name, Logo FROM Company";

    if($data = Query($sql)) {

        while ($row = $data->fetch_assoc()) {
            $ID = $row["ID"];
            $Logo = $row["Logo"];
            $Name = $row["Name"];

            ?>

            <section id="Block">
                <a href="../../../Admin_Portal/Pages/clientProfile.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                            <img src="../../<?php echo $Logo ?>" alt="Company Logo">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Name ?> </h1>
                    </div>
                </a>
            </section>

            <?php
        }
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

            <section id="Block">
                <a href="../../../Admin_Portal/Pages/mentorProfile.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                            <img src="../../<?php echo $ProfilePicture; ?>" alt="Mentor Profile">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Name ?> </h1>
                    </div>
                </a>
            </section>

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

            <section id="Block">
                <a href="../../Client_Portal/Pages/experiment.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                        <img src="<?php echo $Thumbnail ?>" alt="Mentor Profile">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Title ?> </h1>
                    </div>
                </a>
            </section>

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

            <section id="Block">
                <a href="../../../Client_Portal/Pages/experiment.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                        <img src="../../<?php echo $Logo ?>" alt="Mentor Profile">
                    </div>
                    <div class="BlockTitle">
                        <h1> <?php echo $Name ?> </h1>
                    </div>
                </a>
            </section>

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
			<div id="Mentorportait" >
				<a href="../../../Admin_Portal/Pages/mentorProfile.php?id=<?php echo $row['ID'] ?>">link</a>
				<img src="../../<?php echo $row['ProfilePicture']; ?>" alt="Mentor Profile">
				<h1> <?php echo $row['Name'] ?> </h1>
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

        }

        if ($ID == "prototype") {
            $sql = "INSERT INTO Prototype(ID, ExperimentID) VALUES (DEFAULT, '$ExperimentID')";
            Query($sql);

            $_SESSION['insertedID'] = mysqli_insert_id($conn);

        }
    }
}

function insertPitch($Text, $PitchID) {

    $sql = "UPDATE Pitch SET Preparation = '$Text' WHERE ID = '$PitchID'";
    Query($sql);

}

function insertPrototype($ImagePath, $Explain, $PrototypeID) {

    $sql = "INSERT INTO Explanation(PrototypeID, Media, Text) VALUES ('$PrototypeID', '$ImagePath', '$Explain') ";
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
            <textarea name="preparationText" placeholder="Prepare for your pitch"><?php echo $Preparation?></textarea>

            <input type="file" name="file1" id="fileToUpload">


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
            <textarea name="conclusionText" placeholder="Conclusion of your pitch"><?php echo $Conclusion?></textarea> <br/>
            <input type="submit" name="save" value="Save">

            <?php
        }
    }
}
?>
