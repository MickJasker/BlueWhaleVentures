<?php
//This file contains all the functions preparing the database queries. 
//Each function will prepare an sql-string, and an optional array of variables, 
//which will be sent to db_functions.
 
require "connect.php";
require "dbFunctions.php";

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

//Selects all experiment textareas etc
function getDesignSheetForm()
{
	$sql = "SELECT title, description FROM Segment WHERE DesignSheetID = '1'";
		if($data = query($sql))
		{	
			echo '<form method="POST" action="#">';
			
			$i = 1;
			while($row = $data->fetch_assoc())
			{
				echo '<h3>'.$row["title"].'</h3>';
				echo '<textarea name="input'.$i.'" type="text" placeholder="'.$row["description"].'"></textarea>';
				$i++;
			}
			echo '<input name="submit_designsheet" type="submit" value="Enter" >';
			echo '</form>';
		}
		else
		{
			echo "Error retrieving experimentdata";
			return false;
		}
}

function selectUser($Email)
{
	$sql = "SELECT u.ID FROM User u 
	INNER JOIN Login l ON l.UserID = U.ID
	WHERE l.Email = '$Email'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row;
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
	INNER JOIN Company c ON c.FunctionID = 
	WHERE u.ID = '$ID'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
	}
}

function selectCompanyName($UserID)
{
	$sql = "SELECT c.Name FROM Company c
	INNER JOIN User u ON u.ID = c.FunctionID
	WHERE u.ID = '$UserID'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row;
	}
}

function selectUserName2($ID)
{
	$sql = "SELECT c.Name FROM Company c
	WHERE c.ID = '$ID'";

	if ($data = query($sql))
	{
		$row = mysqli_fetch_array($data,MYSQLI_ASSOC);
		return $row;
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
                <a href="../../../Client_Portal/Pages/experiment.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                        <img src="../../<?php echo $Thumbnail ?>" alt="Mentor Profile">
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

?>
