<?php
include_once '../../Main/Includes/PHP/functions.php';
checkSession('Client');
?>
<ul class="list">
    <div class="content">

        <div onclick="createcompany()" id="Block" class="col-lg-4">
            <a class="clientbutton" href="#">
                <div class="BlockLogo">
                    <img src="../../Main/Files/Images/add.svg" alt="Add Bachelor Group">
                </div>
                <div class="BlockTitle">
                    <h1> Add Bachelor Group </h1>
                </div>
            </a>
        </div>

        <?php

        selectBachelorBlockInfo();

        ?>

    </div>
</ul>