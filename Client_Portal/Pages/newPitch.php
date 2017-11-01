<?php
    require '../../Main/Includes/PHP/functions.php';
	checkSession('Company');
    if(isset($_POST['save'])) {
        insertPitch($_POST['preparationText'], $_SESSION['insertedID']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title> New Pitch </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
<body id="wrapper-newPrototype">
<header class="wrapper-nav">
    <?php require "../nav_nosearch.php"?>
</header>
<Main class="row">
    <section class="col-lg-6">
        <div>
            <h1> New Pitch </h1>
            <div id="pitchForm">
                <form id="form" action="#" method="POST">

                    <textarea name="preparationText" placeholder="Prepare for your pitch"></textarea>
                    <input type="submit" name="save" value="Save">

                </form>
            </div>
        </div>
    </section>

</Main>
</body>
</html>