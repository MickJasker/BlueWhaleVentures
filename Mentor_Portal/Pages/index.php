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
	<body id="wrapper-admin-body">
		<header class="wrapper-nav">
			<?php
            require "../nav_mentor.php"
			?>
		</header>
		<Main id="wrapper-admin">

            <ul class="list">
                <div class="content">

			        <?php

			        getMentorAssignedBlockInfo(10);

			        ?>

                </div>
            </ul>
			<script src="../../Main/Includes/Javascript/main.js"></script>
		</Main>
	</body>
</html>