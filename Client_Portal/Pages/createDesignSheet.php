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
				insertDesignSheet();
			?>
		</Main>
	</body>
</html>