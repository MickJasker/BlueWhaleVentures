<?php
//This file contains all the functions preparing the database queries. 
//Each function will prepare an sql-string, and an optional array of variables, 
//which will be sent to db_functions.

//require "connect.php";
require "db_functions.php";

//TEST-QUERIES______________________________________________________________________
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

// Inserts a new set of tour-data into the database
// $date:		The date of the performance
// $Location:	The city the performance is given
// $venue:		The venue the performance is given at
// $buylink:	A link to a ticket-selling service
function insertTourData($date, $location, $venue, $buylink)
{
	$sql = "INSERT INTO agenda (`date`, location, venue, buylink) VALUES ('$date', '$location', '$venue' ,'$buylink')";

	$varArray = array($date, $location, $venue, $buylink);

	$data = Query($sql, $varArray);
	if ($data == true) 
	{
		echo "Tour Data created";
	}
}
//TEST QUERIES________________________________________________________________________

function testQuery($test)
{
	$sql = "SELECT * FROM tabel WHERE ID = '$test'";
	$data = query($sql);

	while($row = $data->fetch_assoc())
	{
		echo "<br>" . $row["ID"];
	}
}

function insertQuery($test2)
{
	$sql = "INSERT INTO tabel(ID) VALUES('$test2')";
	query($sql);
}
?>