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
					$experimentId = $_GET['experimentId'];
					
					foreach ($_POST as $value)
					{
						if ($value != "submit")
						{
							$value = htmlentities(mysqli_real_escape_string($conn, $value));
						}
					}
					
					$language = $_SESSION["Language"];
					insertDesignSheet($_POST, 1, $language, $experimentId);
				}
			?>
		</Main>
	</body>
</html>