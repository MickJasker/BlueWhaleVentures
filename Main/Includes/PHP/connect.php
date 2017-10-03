<?php
//Account settings 
$host = "martijnfl.nl";
$username = "BW-User";
$password = "bwtomatoes";
$database = "BW_Portal";

//Create connection
global $conn;
$conn = mysqli_connect($host, $username, $password, $database);

//Check connection 
if ($conn->connect_error) 
	{
		die("Connection failed: ". $conn->connect_error);
	}
else
	{
		echo "Connected succesfully";
		require "queries.php";
		testQuery();
	}
?>