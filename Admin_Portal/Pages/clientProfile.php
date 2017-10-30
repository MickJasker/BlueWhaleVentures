<?php
require '../../Main/Includes/PHP/functions.php';
CheckSession("Admin");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Client Profile</title>
		<link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,800" rel="stylesheet">
		<script src="../../Main/Includes/Javascript/jquery-3.2.1.min.js"></script>
		<script src="../../Main/Includes/Javascript/load.js"></script>
	</head>

	<body id="wrapper-ClientProfile">
		<header class="row wrapper-nav">
			<?php
            require "../nav_nosearchadmin.php";
			?>
		</header>
		<main>
			<?php
                selectCompanyInfo($_GET["id"]);
             ?>
            
            <div class="wrapper-profile">
	            <div class="row">
		            <section class="block">
						<div class="content">
							<div class="container-fluid logo">
								<img src="../../Main/Files/Images/google.png">
							</div>
							<div class="container-fluid discription">
								<h3>Google Inc.</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor.magn aaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex eacommodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim 	id est laborum.
								</p>
							</div>
						</div>
					</section>
					<section class="block">
			            <div class="title-mentor col-md-4">
				            <h3>Company Information</h3>
			            </div>
						<div class="content">
							<div class="container-fluid logo">
								<p>Lorem ipsum</p>
							</div>
						</div>
					</section>
					<section class="block">
			            <div class="title-mentor col-md-4">
				            <h3>Analytics</h3>
			            </div>
						<div class="content">
							<div class="container-fluid title">

							</div>
							<div class="container-fluid">
							<p>Analytics</p>
							</div>
						</div>
					</section>
	            </div>
	            <div class="row mentor-row">
		            <section class="mentor col-md-8">
			            <div class="title-mentor">
				            <h3>Mentors</h3>
			            </div>
			            <div class="content">
				            <div class="row">
					            <?php selectCompanyMentors($_GET["id"]); ?>
				            </div>
			            </div>
		            </section>
		            <section class="block">
			            <div class="content">
				            <div class="container-fluid discription">
					            <h3>Experiments</h3>
					            <?php getExperimentsPreview($_GET["id"]); ?>
				            </div>
			            </div>
		            </section>
	            </div>
            </div>    
		</main>
		<script src="../../Main/Includes/Javascript/navbar.js"></script>
	</body>
</html>