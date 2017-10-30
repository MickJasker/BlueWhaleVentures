<?php
require '../../Main/Includes/PHP/functions.php';
checkSession("Mentor");
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Mentor Portal </title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
		<script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
		<script src="../../Main/Includes/Javascript/load.js"></script>
		<link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	</head>
	<body>
		<header class="wrapper-nav">
			<?php
			require "../../Main/Includes/nav.php"
			?>
		</header>
		<Main id="wrapper-admin">

			<?php

			getMentorAssignedBlockInfo(10);

			?>
			<script src="../../Main/Includes/Javascript/main.js"></script>
		</Main>
	</body>
</html>