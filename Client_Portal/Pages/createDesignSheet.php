<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Company');
?>
<!DOCTYPE html>
<html>
<head>
    <title> Create a new design sheet </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
	<body id="wrapper-designSheet">
    <header class="wrapper-nav">
        <?php
        require "../../Main/Includes/nav.php"
        ?>
    </header>
		<Main>
            <div id="switch">
                <button id="switchActive">Design sheet</button>
                <button>Executable</button>
            </div>
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