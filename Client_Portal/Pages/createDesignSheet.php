<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Company');
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
        <?php
        require "../../Main/Includes/nav.php"
        ?>
    </header>
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
            <div id="executable"></div>
		</Main>
    <script src="../../Main/Includes/Javascript/designSheet.js"></script>
	</body>
</html>