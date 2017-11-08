<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
checkRange();
$experimentId = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title> Create a new design sheet </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    <script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
</head>
	<body id="wrapper-designSheet">
    <header class="wrapper-nav">
        <?php require "../nav_nosearch.php";?>
    </header>
		<Main>
			<?php
				getDesignSheetForm("Experiment", $_SESSION['Language']);
				if (isset($_POST['submitDesignsheet']))
				{
					$language = $_SESSION["Language"];
					insertDesignSheet($_POST, "Experiment", $language, $experimentId);

					header('Location: chooseExecution.php?experimentID=' . $experimentId);
				}
			?>
            <div id="executable"></div>
		</Main>
    <script src="../../Main/Includes/Javascript/designSheet.js"></script>
	</body>
</html>