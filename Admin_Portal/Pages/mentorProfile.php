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
	</head>

	<body id="wrapper-ClientProfile">
		<header class="row wrapper-nav">
			<?php require "../nav_nosearchadmin.php"; ?>
		</header>
		<main>
		<?php 
			$ID = secure($_GET["id"]);
			$data = getMentorProfile($ID);
		?>
			<?php if ($data[2] != "")
					{
						echo '<img src="'.$data[2].'" alt="Profile picture" height="100px">';
					}
			?>
			
			<p>Name: <?php echo $data[1]; ?></p> <br>
			<p>Mail adres: <?php echo $data[3]; ?></p> <br>
			<p>Company: <?php echo $data[4]; ?> </p> <br>
			<p>Number: <?php echo $data[5]; ?></p> <br>
		</main>
	</body>
</html>