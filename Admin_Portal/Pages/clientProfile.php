<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Client Profile</title>
		<link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
		<script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
		<script src="../../Main/Includes/Javascript/load.js"></script>
	</head>

	<body id="wrapper-nav" class="wrapper-ClientProfile">
		<header class="row">
			<?php
			require "../../Main/Includes/PHP/nav.php"
			?>
		</header>
		<main>
			<?php /*
                require "../../Main/Includes/PHP/queries.php";
                session_start();
                selectCompanyInfo($_GET["ID"]);

                selectCompanyMentors($_GET["ID"]);
            */ ?>
            
            <div class="wrapper-profile">
	            <div class="row">
		            <div class="profile-block col-md-4">
			            <div class="container-fluid">
			            	<h3>Company Profile</h3>
			            </div>
		            </div>
		            <div class="company-information-block col-md-4">
			            <div class="container-fluid">
			            	<h3>Contact</h3>
			            </div>
		            </div>
		            <div class="analytics-block col-md-4">
			            <div class="container-fluid">
			            	<h3>Analytics</h3>
			            </div>
		            </div>
	            </div>
            </div>    
		</main>
		<script src="../../Main/Includes/Javascript/navbar.js"></script>
	</body>
</html>