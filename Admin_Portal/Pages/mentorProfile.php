<?php
    require '../../Main/Includes/PHP/functions.php';
    CheckSession("Admin");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Mentor Profile</title>
		<link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
	</head>

	<body id="wrapper-admin-body">
		<header class="row wrapper-nav">
			<?php require "../nav_nosearchadmin.php"; ?>
		</header>
		<main id="wrapper-profile">

            <div class="content">

                <div class="profile">
                    <div class="picture">
                        <?php
                        $ID = secure($_GET["id"]);
                        $data = getMentorProfile($ID);
                        ?>

                        <?php if ($data[2] != "")
                        {
                            echo '<img src="'.$data[2].'" alt="Profile picture" height="100px">';
                        }
                        ?>
                    </div>
                    <div class="name">
                        <h1><?php echo $data[1]; ?></h1>
                    </div>
                </div>

                <div class="info">

                    <div class="title">
                        <h1>Information</h1>
                    </div>

                    <div class="text">

                        <div class="info1">
                            <h1>E-mail:</h1> <p><?php echo $data[3]; ?></p> <br>
                            <h1>Company:</h1> <p><?php echo $data[4]; ?></p> <br>
                            <h1>Number:</h1> <p><?php echo $data[5]; ?></p> <br>
                        </div>

                    </div>

                </div>
				
            </div>
			<a href="index.php"><button style="float: right; margin-top: 40%; z-index: 50; margin-right: 5%;"> Back </button></a>

		</main>
	</body>
</html>