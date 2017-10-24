 <?php
 require '../../Main/Includes/PHP/functions.php';
 checkSession("Admin");
 ?>
 <ul class="list">
     <div class="content">
         <li id="Block" class="col-lg-4">
             <a href="#">
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