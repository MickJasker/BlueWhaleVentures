<?php
include_once '../../Main/Includes/PHP/functions.php';
checkSession('Client');
?>

<ul class="list">
    <div class="content">

        <div id="Block" class="col-lg-4">
            <a class="mentorbutton" href="createExperiment.php">
                <div class="BlockLogo">
                    <img src="../../Main/Files/Images/add.svg" alt="Add Experiment">
                </div>
                <div class="BlockTitle">
                    <h1> Add Experiment </h1>
                </div>
            </a>
        </div>

        <?php getExperimentBlockInfo($_SESSION["CompanyID"]); ?>

    </div>
</ul>