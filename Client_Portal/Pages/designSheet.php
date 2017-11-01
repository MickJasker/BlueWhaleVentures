<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Company');
$experimentID = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
if (isset($_POST["submitDesignsheet"])) 
{
	updateDesignSheet($_POST, "Experiment", $_SESSION["Language"], $experimentID);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
    <body id="wrapper-admin">
		<h1>Design sheet : Experiment 2</h1>
		<?php
			getDesignSheetData($experimentID, "Experiment", $_SESSION["Language"]);
		?>
		<button id="edit1" onclick='editPage(7, "designSheet")'> Edit </button>
	</body>
</html>