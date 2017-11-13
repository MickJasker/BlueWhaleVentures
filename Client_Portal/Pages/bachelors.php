<?php
	include_once '../../Main/Includes/PHP/functions.php';
	checkSession('Client');
?>

<ul class="list">
    <div class="content">
        <?php selectBachelorBlockGroupMemberInfo(secure($_SESSION['CompanyID'])); ?>
    </div>
</ul>