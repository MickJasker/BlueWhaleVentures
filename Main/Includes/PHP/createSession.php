<?php
	require "queries.php";
	session_start();

function createSession($Email)
{
	$_SESSION["LoggedIn"] = true;
	$_SESSION["Role"] = selectRole($Email);
}
?>