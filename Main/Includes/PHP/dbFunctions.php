<?php

// This file contains all the databasequery-related functions. Calling each one of these functions with an sql-string, and an optional array of variables will execute database queries, and return the results of said queries
function query($sql)
{
	//Gets the database-connection
	global $conn;
	//Checks if string is a SELECT-Query
	if (substr($sql, 0, 6) == "SELECT")
	{
		return selectQuery($sql);
	}
	//Checks if string is a INSERT-Query
	else if (substr($sql, 0, 6) == "UPDATE" || substr($sql, 0, 6) == "INSERT" || substr($sql, 0, 6) == "DELETE")
	{
		return changeQuery($sql);
	}
	//If string is none of the above
	else
	{
		//something went wrong
		echo "An error has occured";
	}
}

//Creates and executes a SELECT-query
//Returns an array with the results
function selectQuery($sql)
{
	//Gets the database-connection
	global $conn;

	$result = $conn->query($sql);
	if ($result->num_rows == 1)
	{
		$row = $result->fetch_assoc();
		return $row;
	}
	else if ($result->num_rows > 1)
	{
		return $result;
	}
	else
	{
		echo "<br> No records";
	}
}

//Creates and executes a INSERT-, UPDATE- or DELETE-query
//Returns a boolean
function changeQuery($sql)
{	
	global $conn;	
	if ($conn->query($sql)) 
	{
    	return true; 
	} 
	else 
	{
    	return false;
	}
}
?>