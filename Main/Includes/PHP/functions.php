<?php
require "queries.php";
session_start();


//This functions generates an random key and sends an email to the user
function generate_key($email, $name, $role)
{
	//array with alphabet + numbers
	$numbers = range(chr(48),chr(57));
	$letters = range(chr(65),chr(90));
	$characters = array_merge($numbers, $letters);
			
	//Generate 6 random numbers
	$number = mt_rand(0, 35); $number2 = mt_rand(0, 35); $number3 = mt_rand(0, 35); 
	$number4 = mt_rand(0, 35); $number5 = mt_rand(0, 35); $number6 = mt_rand(0, 35);
			
	//Get characters from array with the random generated numbers
	$generatedkey = $characters[$number] . $characters[$number2] . $characters[$number3] . $characters[$number4] . $characters[$number5] . $characters[$number6];
					
	//Make url
	$url = "http://localhost/BW-Ventures/main/pages/createAccount.php"; //Put the url in here 
	$link = $url . "?key=" . $generatedkey;
	
	//Time + 31 days YYYY-MM-DD HH:MI:SS
	$activetime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +31 days"));
	
	//Insert the code in the db
	if (createCode($email, $name, $generatedkey, $activetime, $role)) //Insert key in db, Doesnt work yet
	{	
		return true;
	}	
	else
	{
		return false;
	}
}

function createSession($Email)
{
	$_SESSION["LoggedIn"] = true;
	$_SESSION["Role"] = selectRole($Email);
	$_SESSION["UserID"] = selectUser($Email);
}

function checkSession($AllowedRole)
{
	if (!$_SESSION["LoggedIn"] || $_SESSION["Role"] != $AllowedRole)
	{
		return false;
	}

	return true;
}

function destroySession()
{
	unset($_SESSION["LoggedIn"]);
	unset($_SESSION["Role"]);
	unset($_SESSION["UserID"]);
}
?>