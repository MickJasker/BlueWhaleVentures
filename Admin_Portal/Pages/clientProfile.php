<?php
require '../../Main/Includes/PHP/functions.php';
    //CheckSession("Admin");


    if (isset($_POST['save'])) 
    {
        assignMentor(secure($_GET['id']), $_POST['mentor']);
	}

    if (isset($_GET['action']))
    {
        if (secure($_GET['action']) == "delete")
        {
            unassignMentor(secure($_GET['companyID']), secure($_GET['id']));
        }

        if (secure($_GET['action']) == "lock")
        {
            if (updateCompanyLock($_GET['id'], 1) == true)
            {
                echo "The account was locked";
            }
        }

        if (secure($_GET['action']) == "unlock")
        {
            if (updateCompanyLock($_GET['id'], 0) == true)
            {
                echo "The account was unlocked";
            }
        }
    }

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
			<?php require "../nav_nosearchadmin.php"; ?>
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
                selectCompanyInfo($_GET["id"]);
                selectLockButton($_GET["id"]);
            ?>
		</main>
		<script src="../../Main/Includes/Javascript/navbar.js"></script>
        <script src="../../Main/Includes/Javascript/main.js"></script>
    </body>
</html>