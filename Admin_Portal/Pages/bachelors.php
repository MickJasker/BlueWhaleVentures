<?php
include_once '../../Main/Includes/PHP/functions.php';
CheckSession("Admin");
?>
<div id="toggle_bachelor">
    <div id="text">
        <h1 id="clients" onclick="selectclient()">
            Clients
        </h1>
        <h1 id="bachelor" onclick="selectbachelor()"class="border-bottom">
            Bachelor Groups
        </h1>
    </div>
</div>

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

        <div onclick="createBachelorGroup()" id="Block" class="col-lg-4">
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