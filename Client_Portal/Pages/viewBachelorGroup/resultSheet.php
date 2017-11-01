<!DOCTYPE html>
<?php
require '../../Main/Includes/PHP/functions.php';
?>

<html>
	<head>
	    <title> Client Portal </title>
	    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	</head>
    <body id="wrapper-admin">
		<h1>Design sheet : Experiment 2</h1>
		<?php
			getDesignSheetData($_GET["experimentID"], "Result", $_SESSION["Language"]);
		?>
	</body>
</html>