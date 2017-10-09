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
?>