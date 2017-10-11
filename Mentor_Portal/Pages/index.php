<?php
//require '../../Main/Includes/PHP/functions.php';
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
	<body id="wrapper-admin">
		<header class="wrapper-nav">
			<?php
			require "../../Main/Includes/nav.php"
			?>
		</header>
		<Main>
			<div class="row">

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/add.svg" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> Add Client </h1>
						</div>
					</a>
				</section>

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/google.png" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> Google </h1>
						</div>
					</a>
				</section>

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/amazon.png" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> Amazon </h1>
						</div>
					</a>
				</section>

			</div>

			<div class="row">

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/poliana.png" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> Poliana </h1>
						</div>
					</a>
				</section>

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/microsoft.png" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> Microsoft </h1>
						</div>
					</a>
				</section>

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/paypal.png" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> PayPal </h1>
						</div>
					</a>
				</section>

			</div>

			<div class="row">

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/poliana.png" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> Poliana </h1>
						</div>
					</a>
				</section>

				<section id="Block" class="col-lg-4">
					<a href="#">
						<div class="BlockLogo">
							<img src="../../Main/Files/Images/microsoft.png" alt="Add Client">
						</div>
						<div class="BlockTitle">
							<h1> Microsoft </h1>
						</div>
					</a>
				</section>

			</div>

			<?php

			//getMentorAssignedBlockInfo(10)

			?>
			<script src="../../Main/Includes/Javascript/main.js"></script>
		</Main>
	</body>
</html>