<?php
	require '../../Main/Includes/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Admin Portal </title>
		<link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	</head>
	<body id="wrapper-admin">

        <header>

            <?php include '../../Main/Includes/nav.php';?>

        </header>

        <Main>

            <section id="Block">
                <a href="#">
                    <div class="BlockLogo">
                        <img src="../../Main/Files/Images/blue_plus.png" alt="Add Client">
                    </div>
                    <div class="BlockTitle">
                        <h1> Add Client </h1>
                    </div>
                </a>
            </section>

            <?php

            //getCompanyBlockInfo();

            ?>


            <section id="Block">
                <a href="#">
                    <div class="BlockLogo">
                        <img src="../../Main/Files/Images/blue_plus.png" alt="Add Client">
                    </div>
                    <div class="BlockTitle">
                        <h1> Add Mentor </h1>
                    </div>
                </a>
            </section>

            <?php

            //getMentorBlockInfo();

            ?>

            <script src="../../Main/Includes/Javascript/navbar.js"></script>

        </Main>
	</body>
</html>