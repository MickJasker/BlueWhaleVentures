<?php
require '../connect.php';
	
	function sqlquery($sql, $type)
	{
		global $conn;
		
		if ($sql == "")
		{
			echo "An error has occurred";
		}
		else if (substr($sql, 0, 6) == "SELECT")
		{	
			return selectquery($sql, $type);
		}
		else if (substr($sql, 0, 6) == "UPDATE" || substr($sql, 0, 11) == "INSERT INTO" || substr($sql, 0, 11) == "DELETE FROM")
		{
			return changequery($sql);
		}
		else
		{
			echo "An error has occurred";
		}
	}
	
	//Select query
	function selectquery($sql, $type)
	{
		global $conn;
		
		$result = $conn->query($sql);
			if ($type == 1) 
			{
				$row = $result->fetch_assoc();
		    	return $row;
			}
			else if ($type == 2)
			{
				return $result;
			}

	}
	
	//DELETE, UPDATE and INSERT query
	function changequery($sql)
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