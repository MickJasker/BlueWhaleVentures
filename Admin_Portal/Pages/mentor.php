<?php
require '../../Main/Includes/PHP/functions.php';
checkSession("Admin");
?>
<ul class="list">
    <div class="content">

        <?php

        getMentorBlockInfo();

        ?>

    </div>
</ul>