<?php

$servername = "Localhost";
$username = "root";
$password = "";
$dbname = "test";

//Account settings 
/*
$servername = "martijnfl.nl";
$username = "BW-User";
$password = "bwtomatoes";
$dbname = "BW_Portal";
*/

//Create connection
global $conn;
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection 
if ($conn->connect_error) 
	{
		die("Connection failed: ". $conn->connect_error);
	}
else
	{
		echo "Connected succesfully";
		require "queries.php";
		testQuery(6);
	}
?>