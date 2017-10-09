<?php
//This file contains all the functions preparing the database queries. 
//Each function will prepare an sql-string, and an optional array of variables, 
//which will be sent to db_functions.

//require "connect.php";
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

?>