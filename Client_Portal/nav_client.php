<div id="nav">

	<a href="index.php"><img id="logo" src="../../Main/Files/Images/logo.svg" class="col-md-1"></a>


	<h4 id="left">
		Welcome, <span class="user"><?php getUserNames($_SESSION["UserID"]); ?></span>
	</h4>

    <div id="experimentswitch" class="col-md-3">

        <h4>
            <span id="experiments" class="blue">Experiments</span>
        </h4>

        <label class="switch">
            <input id="checkbox" onclick="selectexpbachelor()" type="checkbox">
            <span class="slider round"></span>
        </label>

        <h4>
            <span id="bachelors">Bachelor Groups</span>
        </h4>

    </div>

    <div class="input_fields">

        <div id="searchdiv">

            <input onkeyup="searchbarfunction()" type="text" id="searchbar" placeholder="Search for Experiment">

        </div>
    </div>

	<h4 id="right">
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/index.php">Home </a>
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/Profile.php">Profile</a>
		<a href="../../Main/Pages/logout.php">Logout</a>
	</h4>
</div>