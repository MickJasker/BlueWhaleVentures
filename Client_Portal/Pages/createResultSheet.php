<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
checkRange();
$experimentId = checkExperimentID(secure($_GET["experimentid"]), $_SESSION["CompanyID"]);
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
			<?php
				getDesignSheetForm("Result", $_SESSION['Language']);
				if (isset($_POST['submitDesignsheet']))
				{
					$language = $_SESSION["Language"];
					insertDesignSheet($_POST, "Result", $language, $experimentId);

					header('Location: index.php');
				}
			?>
		</Main>
	</body>
</html>