<?php
    include_once '../../Main/Includes/PHP/functions.php';
    CheckSession("Admin");

if (isset($_POST['generate_companykey']))
{
	$user_name = secure($_POST['user_name']);
	$company_mail = secure($_POST['company_mail']);
	
	if (!(strlen($user_name) >= 1 && strlen($user_name) <= 32))
	{
		echo '<script>message("The name should be between 1 and 32 characters", "bad");</script>';	
	}
	else if (!filter_var($company_mail, FILTER_VALIDATE_EMAIL))
	{
		echo '<script>message("The E-mail adress is not correct", "bad");</script>';	
	}
	else
	{
		if (generate_key($company_mail, $user_name, "Company"))
		{
			echo '<script>message("Key has been generated", "good");</script>';	
		}
	}
}

if (isset($_POST['generate_adminkey']))
{
	$user_name = secure($_POST['admin_name']);
	$company_mail = secure($_POST['admin_mail']);
	
	if (!(strlen($user_name) >= 1 && strlen($user_name) <= 32))
	{
		echo '<script>message("The name should be between 1 and 32 characters", "bad");</script>';	
	}
	else if (!filter_var($company_mail, FILTER_VALIDATE_EMAIL))
	{
		echo '<script>message("The E-mail adress is not correct", "bad");</script>';	
	}
	else
	{
		if (generate_key($company_mail, $user_name, "Admin"))
		{
			echo '<script>message("Key has been generated", "good");</script>';	
		}
	}
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
		<div style="float:right; margin: 10px;" >
			<h1> Add admin: </h1>
			<img onclick="createadmin();" style="float:right; margin-left: 20px; margin-top: -55px; margin-right: 20px;" width="50px" src="../../Main/Files/Images/add.svg" onmouseover='this.style.cursor="pointer"' >
		</div>
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
 
 <div id="adminform" class="clientmodal">
     <!-- Modal content -->
     <div class="clientmodal-content">
         <div class="clientmodal-header">
             <span class="close">&times;</span>
             <h2>Add admin</h2>
         </div>
         <div class="clientmodal-body">
             <form method="POST" action="#">
                 <input id="field" type="text" name="admin_name" placeholder="Name"> <br>
                 <input id="field" type="text" name="admin_mail" placeholder="E-mail"> <br>
                 <input id="submitbtn" name="generate_adminkey" type="submit" value="Add admin">
             </form> 
         </div>
     </div>
 </div>