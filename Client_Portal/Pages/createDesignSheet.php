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
				getDesignSheetForm();
				if (isset($_POST['submitDesignsheet']))
				{
					$experimentId = $_GET['experimentID'];
					$language = $_SESSION["Language"];
					insertDesignSheet($_POST, "Experiment", $language, $experimentId);

					//redirect to execution page
				}
			?>
		</Main>
	</body>
</html>