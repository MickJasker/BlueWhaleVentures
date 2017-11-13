<?php
    include_once '../../Main/Includes/PHP/functions.php';
    CheckSession("Admin");

    if (isset($_POST['saveBachelorMember']))
    {
        if (isset($_POST['company'])) {

            if (secure($_POST['company']) != "") {
                insertToBachelorGroup(secure($_GET['id']), secure($_POST['company']));
            }
        }
    }

    if (isset($_GET['action'])) {

        if (secure($_GET['action']) == "delete") {

            deleteBachelorGroupMember(secure($_GET['companyID']) ,secure($_GET['bachelorID']));

        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> Bachelor Group </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
<body id="wrapper-admin-body">
<header class="row wrapper-nav">
    <?php
    require "../nav_nosearchadmin.php"
    ?>
</header>
<Main id="wrapper-admin">
    <div id="clientform" class="clientmodal">
        <!-- Modal content -->
        <div class="clientmodal-content">
            <div class="clientmodal-header">
                <span class="close">&times;</span>
                <h2>Add Bachelor Group</h2>
            </div>
            <div class="clientmodal-body">
                <form method="POST" action="#">

                    <?php selectCompanyDropdown(); ?>

                    <input id="submitbtn" name="saveBachelorMember" type="submit" value="Add bachelor group">
                </form>
            </div>
        </div>

    </div>

    <div id="toggle_bachelor">
        <div id="text">
            <form action="index.php">
                <input type="submit" value="Back" />
            </form>

                <?php

                selectBachelorName(secure($_GET['id']));

                ?>
        </div>
    </div>

    <ul class="list">
        <div class="content">

            <div onclick="createcompany()" id="Block" class="col-lg-4">
                <a class="clientbutton" href="#">
                    <div class="BlockLogo">
                        <img src="../../Main/Files/Images/add.svg" alt="Add To Bachelor Group">
                    </div>
                    <div class="BlockTitle">
                        <h1> Add To Bachelor Group </h1>
                    </div>
                </a>
            </div>

            <?php

               selectBachelorGroupBlockInfo(secure($_GET['id']));

            ?>
        </div>
    </ul>
</Main>

<script src="../../Main/Includes/Javascript/main.js"></script>

</body>
</html>