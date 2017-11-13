<?php
	require '../../Main/Includes/PHP/functions.php';
	checkSession('Client');
	checkRange();
	$experimentId = checkExperimentID(secure($_GET["experimentid"]), $_SESSION["CompanyID"]);

	if (isset($_POST['submitDesignsheet']))
	{
		insertDesignSheet($_POST, "Result", $_SESSION["Language"], $experimentId);

		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Create a new result sheet </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
	<body id="wrapper-designSheet">
    <header class="wrapper-nav">
        <?php require "../nav_nosearch.php";?>
    </header>
		<Main>
			<?php getDesignSheetForm("Result", $_SESSION['Language']); ?>
		</Main>
	</body>
</html>