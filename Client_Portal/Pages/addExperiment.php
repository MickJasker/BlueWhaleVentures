<?php
require '../../Main/Includes/PHP/functions.php';
if (isset($_POST["submit"]))
{
    createExperiment($_SESSION["UserID"], $_POST["experimentTitle"], $_POST["experimentThumb"], $_POST["experimentDesc"]);
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
            <form method="POST" action="#">
                <input type="text" placeholder="Name" name="experimentTitle"><br><br>
                <input type="file" placeholder="Thumbnail" name="experimentThumb"><br><br>
                <input type="textarea" placeholder="Description" name="experimentDesc"><br>             
                <input type="submit" placeholder="Create experiment" name="submit">
            </form>
        </Main>
    </body>
</html>