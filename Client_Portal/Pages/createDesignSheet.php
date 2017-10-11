<?php
require '../../Main/Includes/PHP/functions.php';
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
					insertDesignSheet($experimentId, $_POST);					
				}
			?>
		</Main>
	</body>
</html>