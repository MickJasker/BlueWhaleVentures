<?php
require '../../Main/Includes/PHP/functions.php';
checkSession("Admin");

				if (isset($_POST['generate_mentorkey']))
				{
					echo '<p>';
					$user_name = htmlentities(mysqli_real_escape_string($conn, $_POST['user_name']));
					$company_mail = htmlentities(mysqli_real_escape_string($conn, $_POST['company_mail']));
					
					if (!(strlen($user_name) >= 1 && strlen($user_name) <= 32))
					{
						echo "The name should be between 1 and 32 characters";
					}
					else if (!filter_var($company_mail, FILTER_VALIDATE_EMAIL))
					{
						echo "The E-mail adress is not correct";
					}
					else
					{
						generate_key($company_mail, $user_name, "Mentor");
					}
					echo '</p>';
				}
?>
<div id="mentorform" class="mentormodal">

    <!-- Modal content -->
    <div class="mentormodal-content">
        <div class="mentormodal-header">
            <span class="close">&times;</span>
            <h2>Add Mentor</h2>
        </div>
        <div class="mentormodal-body">
            <form method="POST" action="#">
                <input id="field" type="text" name="user_name" placeholder="Name"> <br>
                <input id="field" type="text" name="company_mail" placeholder="E-mail"> <br>
                <input id="submitbtn" name="generate_mentorkey" type="submit" value="Add mentor">
            </form>
        </div>
    </div>

</div>

<ul class="list">
    <div class="content">

        <div onclick="creatementor()" id="Block" class="col-lg-4">
            <a class="mentorbutton" href="#">
                <div class="BlockLogo">
                    <img src="../../Main/Files/Images/add.svg" alt="Add Client">
                </div>
                <div class="BlockTitle">
                    <h1> Add Mentor </h1>
                </div>
            </a>
        </div>

        <?php

        getMentorBlockInfo();

        ?>

    </div>
</ul>