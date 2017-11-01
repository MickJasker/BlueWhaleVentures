<?php

    include_once '../../Main/Includes/PHP/functions.php';

    //CheckSession("Admin");


    if (isset($_GET['action'])) {

        if (secure($_GET['action']) == "delete") {

            deleteBachelorGroup(secure($_GET['bachelorID']));

        }
        else {

        }
    }
    else {

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
    require "../nav.php"
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
                    <input id="field" type="text" name="user_name" placeholder="Name"> <br>
                    <input id="field" type="text" name="company_mail" placeholder="E-mail"> <br>
                    <input id="submitbtn" name="generate_companykey" type="submit" value="Add bachelor group">
                </form>
            </div>
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