<!DOCTYPE html>
<?php 
require '../../Main/Includes/PHP/functions.php';
?>
<html>
	<head>
	    <title> Admin Portal </title>
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
	    <script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
	    <script src="../../Main/Includes/Javascript/load.js"></script>
	    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	    <link rel="icon" href="../../Main/Files/Images/icon.svg"/>
	    <script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
	</head>
	<body id="wrapper-admin-body">
		<script src="../../Main/Includes/Javascript/load.js"></script>

		<header class="wrapper-nav">
		    <?php include '../nav_experiment.php'; ?>
		</header>

		<Main id="wrapper-admin">
            <a href="index.php"> <button style="float:left; margin: 15px;"> Back </button> </a>
			<ul class="list">
     			<div class="content">
		    		<?php getExperimentBlockInfo($_GET["id"]); ?>
				</div>
			</ul>
		</Main>

		<script src="../../Main/Includes/Javascript/main.js"></script>
	</body>
</html>