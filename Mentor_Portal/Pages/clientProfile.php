<?php
    require '../../Main/Includes/PHP/functions.php';
    checkSession('Mentor');
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
        <script src="../../Main/Includes/Javascript/main.js"></script>
    </head>

	<body id="wrapper-ClientProfile">
		<header class="row wrapper-nav">
			<?php require "../nav_nosearchmentor.php"; ?>
		</header>
		<main>
            <div id="mentormodal">

                <!-- Modal content -->
                <div class="mentormodal-content">
                    <div class="mentormodal-header">
                        <span class="close">&times;</span>
                        <h2>Assign Mentor</h2>
                    </div>
                    <div class="mentormodal-body">
                        <form method="POST" action="#">
                            <?php selectMentorDropdown(secure($_GET['id'])); ?>
                            <input id="submitbtn" name="save" type="submit" value="Assign mentor">
                        </form>
                    </div>
                </div>
            </div>
			<?php
            selectCompanyInfoGuttedMentor(secure($_GET["id"]));
            ?>
		</main>
		<script src="../../Main/Includes/Javascript/navbar.js"></script>
        <script src="../../Main/Includes/Javascript/main.js"></script>
    </body>
</html>