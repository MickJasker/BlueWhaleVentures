<?php
include_once '../../Main/Includes/PHP/functions.php';

if (isset($_POST['generate_companykey']))
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
		generate_key($company_mail, $user_name, "Company");
	}
	echo '</p>';
}
?>
<div id="toggle_bachelor">
    <div id="text">
        <h1 id="clients" onclick="selectclient()" class="border-bottom">
            Clients
        </h1>
        <h1 id="bachelor" onclick="selectbachelor()">
            Bachelor Groups
        </h1>
    </div>
</div>

 <div id="clientform" class="clientmodal">
     <!-- Modal content -->
     <div class="clientmodal-content">
         <div class="clientmodal-header">
             <span class="close">&times;</span>
             <h2>Add Client</h2>
         </div>
         <div class="clientmodal-body">
             <form method="POST" action="#">
                 <input id="field" type="text" name="user_name" placeholder="Name"> <br>
                 <input id="field" type="text" name="company_mail" placeholder="E-mail"> <br>
                 <input id="submitbtn" name="generate_companykey" type="submit" value="Add company">
             </form> 
         </div>
     </div>
 </div>

 <ul class="list">
     <div class="content">
         <div onclick="createcompany()" id="Block" class="col-lg-4">
             <a class="clientbutton" href="#">
                 <div class="BlockLogo">
                     <img src="../../Main/Files/Images/add.svg" alt="Add Client">
                 </div>
                 <div class="BlockTitle">
                     <h1> Add Client </h1>
                 </div>
             </a>
         </div>

         <?php getCompanyBlockInfo(); ?>

     </div>
 </ul>