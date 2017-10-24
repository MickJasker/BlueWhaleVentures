<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Company');
?>
<!DOCTYPE html>
<html>
<head>
    <title> Create a new design sheet </title>
</head>
	<body id="wrapper-admin">
		<Main>
			<?php
				getDesignSheetForm("Experiment", $_SESSION['Language']);
				if (isset($_POST['submitDesignsheet']))
				{
					$experimentId = $_GET['experimentID'];
					$language = $_SESSION["Language"];
					insertDesignSheet($_POST, "Experiment", $language, $experimentId);

					header('Location: chooseExecution.php?experimentID=' . $_GET['experimentID']);
				}
			?>
		</Main>
	</body>
</html>