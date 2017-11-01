<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
$experimentId = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
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
            <div id="switch">
                <button id="switchActive">Result sheet</button>
                <button>Executable</button>
            </div>
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