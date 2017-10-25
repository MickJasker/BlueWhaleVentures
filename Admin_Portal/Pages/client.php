 <?php
 require '../../Main/Includes/PHP/functions.php';
 checkSession("Admin");
 ?>

 <div id="clientform" class="clientmodal">

     <!-- Modal content -->
     <div class="clientmodal-content">
         <div class="clientmodal-header">
             <span class="close">&times;</span>
             <h2>Add Client</h2>
         </div>
         <div class="clientmodal-body">
             <form method="POST" action="#">
                 <input id="field" type="text" name="user_name" placeholder="User name"> <br>
                 <input id="field" type="text" name="company_mail" placeholder="E-mail"> <br>
                 <input id="submitbtn" name="generate_companykey" type="submit" value="Add company">
             </form>
         </div>
     </div>

 </div>

 <ul class="list">
     <div class="content">
         <li onclick="createcompany()" id="Block" class="col-lg-4">
             <a class="clientbutton" href="#">
                 <div class="BlockLogo">
                     <img src="../../Main/Files/Images/add.svg" alt="Add Client">
                 </div>
                 <div class="BlockTitle">
                     <h1> Add Client </h1>
                 </div>
             </a>
         </li>

         <?php

         getCompanyBlockInfo();

         ?>
     </div>
 </ul>