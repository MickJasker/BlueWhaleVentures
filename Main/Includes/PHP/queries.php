<?php
//This file contains all the functions preparing the database queries. 
//Each function will prepare an sql-string, and an optional array of variables, 
//which will be sent to db_functions.

require "connect.php";
require "dbFunctions.php";

//TEST-QUERY______________________________________________________________________
// Checks all account information in the database for the right combination.
// Returns true or false.
function checkLogin($username, $password)
{
	$sql = "SELECT username, password FROM login";

	$data = Query($sql);

	while($row = $data->fetch_assoc()) 
	{
		if ($username == $row["username"])
		{
			$hash = password_verify($password, $row["password"]);
			if ($hash != 0)
			{
				return true;					
			}
		}
	}

	return false;
}

//TEST QUERIES________________________________________________________________________

function testQuery($test)
{
	$sql = "SELECT * FROM User WHERE ID = '$test'";
	$data = query($sql);

	while($row = $data->fetch_assoc())
	{
		echo "<br>" . $row["ID"];
	}
}

function insertQuery($test2)
{
	$sql = "INSERT INTO User(ID) VALUES('$test2')";
	query($sql);
}

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
	$sql = "INSERT INTO `User`(`RoleID`,`Language`, `Name`, `Locked`) VALUES ('$role','English','$user_name', '1')";
	
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

function selectUserName($ID)
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
    WHERE r.Role = Mentor";

    if($data = Query($sql)) 
    {
        while ($row = $data->fetch_assoc()) 
        {
            $ID = $row["ID"];
            $Logo = $row["ProfilePicture"];
            $Name = $row["Name"];

            ?>

            <section id="Block">
                <a href="../../../Admin_Portal/Pages/mentorProfile.php?id=<?php echo $ID ?>">
                    <div class="BlockLogo">
                            <img src="../../<?php echo $ProfilePicture ?>" alt="Mentor Profile">
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

function selectCompanyMentors()
{
	$sql = "";
}

function selectCompanyInfo($CompanyID)
{
	$sql = "SELECT c.Name, c.Logo, c.Email, c.Phone, c.Address FROM Company c
	WHERE c.ID = '$CompanyID'";

	if($data = Query($sql)) 
    {
    	$row = mysqli_fetch_array($data,MYSQLI_ASSOC);

    	?>

    	<section id="TempColumn">
    		<div class="TempColLogo">
    			<img src="../../<?php echo $row['c.Logo'] ?>" alt="Company Logo">
    		</div>
			<div class="TempColDescription">
				<h1> <?php echo "Description doesnt exist yet!" ?> </h1>
			</div>
		</section>

		<section id="TempColumn">
			<div class="Temptable">
				<table>
					<tr>
						<th>Phone</th>
						<td><?php echo "AA"; ?></td>
					</tr>
				</table>

		</section>
		<?php
    }
}

?>
