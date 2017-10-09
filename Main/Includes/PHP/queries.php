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

function checkKey($key)
{
	$sql = "SELECT ID, RoleID FROM User WHERE KeyCode = '$key'";
	if($data = query($sql))
	{
		while($row = $data->fetch_assoc())
		{
			$id = $row["id"];
			$role = $row["role"];
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
?>