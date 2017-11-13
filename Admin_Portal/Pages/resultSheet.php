<?php
	require '../../Main/Includes/PHP/functions.php';
	CheckSession("Admin");
?>

<!DOCTYPE html>
<html>
	<head>
	    <title> Admin Portal </title>
	    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	</head>
	<body id="wrapper-designSheet">
        <header class="wrapper-nav">
            <?php require "../nav_nosearchadmin.php";?>
        </header>
        <main>
			<?php
				getDesignSheetData($_GET["experimentID"], "Result", $_SESSION["Language"]);
			?>
	</body>
</html>