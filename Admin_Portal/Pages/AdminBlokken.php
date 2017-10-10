<!doctype html>
<html lang="en">
    <head>
        <?php
            require '../../Main/Includes/PHP/functions.php';
        ?>
    </head>
    <nav>
    </nav>
    <body>
        <Main>

            <section id="Block">
                <a href="#">
                    <div class="BlockLogo">
                        <img src="../../Main/Files/Images/blue_plus.png" alt="Add Client">
                    </div>
                    <div class="BlockTitle">
                        <h1> Add Client </h1>
                    </div>
                </a>
            </section>

            <?php

            getCompanyBlockInfo();

            ?>


            <section id="Block">
                <a href="#">
                    <div class="BlockLogo">
                        <img src="../../Main/Files/Images/blue_plus.png" alt="Add Client">
                    </div>
                    <div class="BlockTitle">
                        <h1> Add Mentor </h1>
                    </div>
                </a>
            </section>

            <?php

            getMentorBlockInfo();

            ?>


        </Main>
    </body>
</html>