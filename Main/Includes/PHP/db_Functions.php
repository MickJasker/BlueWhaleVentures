<?php
// This file contains all the databasequery-related functions. Calling each one of these functions with an sql-string, and an optional array of variables will execute database queries, and return the results of said queries
function Query($sql)
{
	echo "<br>" . $sql;
	//Gets the database-connection
	global $conn;

	//$varArray = ProtectData($varArray);

	//Checks if string is a SELECT-Query
	if (strpos($sql, "SELECT") !== FALSE)
	{
		return SelectQuery($sql);
	}
	//Checks if string is a INSERT-Query
	else if (strpos($sql, "INSERT") !== FALSE)
	{
		return InsertQuery($sql);
	}
	//Checks if string is a UPDATE-Query
	else if (strpos($sql, "UPDATE") !== FALSE)
	{
		return UpdateQuery($sql);
	}
	//Checks if string is a DELETE-Query
	else if (strpos($sql, "DELETE") !== FALSE)
	{
		return DeleteQuery($sql);
	}
	//If string is none of the above
	else
	{
		//something went wrong
		echo "ERROR: No query found";
	}
}

//DOESN'T WORK, LEAVING IT AS A REMINDER TO SECURE CODE
/*
// Changes the data of the variables to a mysqli_real_escape_string, preventing injection
function ProtectData($varArray = array())
{
	global $conn;

	$insertArray = array();
	foreach ($varArray as $i) 
	{
    	$i = mysqli_real_escape_string($conn, $i);
    	$i = htmlentities($i, ENT_QUOTES);
    	$i = $i . "fgzzdshs";
    	array_push($insertArray, $i);
    }

    return $insertArray;
}
*/

//Creates and executes a SELECT-query, and returns an arrya with the results
function SelectQuery($sql)
{
	global $conn;

	echo "<br> Start";

	$result = $conn->query($sql);

	echo "<br> Test connection";

	if ($result->num_rows > 0) 
	{
		echo "<br> Records";
        return $result;
	}
	else
	{
		echo "<br> No records";
	}
}

function ChangeQuery()
{		
	if ($conn->query($sql)) 
	{
    	return true; 
	} 
	else 
	{
    	return false;
	}
}

//Creates an INSERT-query
function InsertQuery($sql = '', $varArray = array(''))
{
	global $conn;
	$varArray = ProtectData($varArray);
	if ($sql != '')
	{
		if ($conn->query($sql)) 
		{
    		return true;
		} 
		else 
		{
    		return false;
		}
	}
	
	return false;
}

//Creates an UPDATE-query
function UpdateQuery($sql = '', $varArray = array(''))
{
	global $conn;
	$varArray = ProtectData($varArray);

	if ($sql != '')
	{
		if ($conn->query($sql)) 
		{
    		return true;
		} 
		else 
		{
    		return false;
		}
	}

	return false;
}

//Creates an DELETE-query
function DeleteQuery($sql = '', $varArray = array(''))
{
	global $conn;
	$varArray = ProtectData($varArray);

	if ($sql != '')
	{
		if ($conn->query($sql)) 
		{
    		return true;
		} 
		else 
		{
    		return false;
		}
	}

	return false;
}
?>