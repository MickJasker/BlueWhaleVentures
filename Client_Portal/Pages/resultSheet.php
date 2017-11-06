<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
$experimentID = checkExperimentID(secure($_GET["experimentid"]), $_SESSION["CompanyID"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	<script src="../../Main/Includes/Javascript/functions.js"></script>
</head>
    <body id="wrapper-admin">
		<?php
			getDesignSheetData($experimentID, "Result", $_SESSION["Language"]);
		?>
	</body>
</html>