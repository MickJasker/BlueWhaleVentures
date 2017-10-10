<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Client Profile</title>
        <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
    </head>

    <body id="wrapper">
        <main class="row">
            <?php
                require "../../Main/Includes/PHP/queries.php";
                session_start();
                selectCompanyInfo($_GET["ID"]);

                selectCompanyMentors($_GET["ID"]);
            ?>
        </main>
    </body>
</html>