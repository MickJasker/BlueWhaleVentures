<?php
require '../../Main/Includes/PHP/functions.php';
checkSession('Client');
$experimentId = checkExperimentID(secure($_GET["experimentID"]), $_SESSION["CompanyID"]);
if(isset($_POST['interview']) || isset($_POST['pitch']) || isset($_POST['prototype'])) {
    sendExecution($_POST, $experimentId);

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
    <h1> Choose Execution </h1>
    <div id="chooseExecutionForm">
        <form id="form" action="#" method="POST">
            <input type="submit" name="interview" value="Interview">
            <input type="submit" name="pitch" value="Pitch">
            <input type="submit" name="prototype" value="Prototype">
        </form>
    </div>
</Main>
</body>
</html>