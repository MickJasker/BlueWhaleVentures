<?php
require '../../Main/Includes/PHP/functions.php';
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
			getDesignSheetData($_GET["experimentID"]);
			
		?>
		<button id="edit1" onclick="editPage(7)"> Edit </button>
	</body>
</html>