<div id="nav">

	<img id="logo" src="../../Main/Files/Images/logo.svg" class="col-md-1">


	<h4 id="left">
		Welcome, <span class="user"><?php getUserNames($_SESSION["UserID"]); ?></span>
	</h4>

	<div id="clientswitch" class="col-md-3">

		<h4>
			<span id="client" class="blue">Client</span>
		</h4>

		<label class="switch">
			<input id="checkbox" onclick="selectclientormentor()" type="checkbox">
			<span class="slider round"></span>
		</label>

		<h4>
			<span id="mentor">Mentor</span>
		</h4>

	</div>
    <div class="input_fields">
        <div class="filter">

            <input onkeyup="filterfunction()" id="input" type="text" class="filterbtn" placeholder="Filter">

            <ul id="content" class="filter-content">
                <li><a href="#" onclick="filterclick()">Games</a></li>
                <li><a href="#" onclick="filterclick()">Navigation</a></li>
                <li><a href="#" onclick="filterclick()">Fashion</a></li>
            </ul>

        </div>

        <div id="searchdiv">

            <input onkeyup="searchbarfunction()" type="text" id="searchbar" placeholder="Search for Client">

        </div>
    </div>

	<h4 id="right">
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/index.php">Home </a>
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/Profile.php">Profile</a>
		<a href="../../Main/Pages/logout.php">Logout</a>
	</h4>
</div>