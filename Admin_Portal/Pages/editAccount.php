<?php
require '../../Main/Includes/PHP/functions.php';
if (isset($_POST["submit"]))
{
    updateAdminProfile($_SESSION["UserID"], $_POST["adminName"], $_POST["adminPic"], $_POST["adminLang"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Client Portal </title>
    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
</head>
    <body id="wrapper-admin">
        <Main>
            <?php
                selectAdminProfile($_SESSION["UserID"]);
            ?>
        </Main>
    </body>
</html>