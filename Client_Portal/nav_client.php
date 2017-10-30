<div id="nav">

	<img id="logo" src="../../Main/Files/Images/logo.svg" class="col-md-1">


	<h4 id="left" class="col-md-2">
		Welcome, <span class="user">Client</span>
	</h4>

	<h4 id="right" class="col-md-2">
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/index.php">Home </a>
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/Profile.php">Profile</a>
		<a href="../Main/Pages/logout.php">Logout</a>
	</h4>
	<div class="input_fields col-md-4">

		<div id="searchdiv">

			<input onkeyup="searchbarfunction()" type="text" id="searchbar" placeholder="Search for Experiment">

		</div>
	</div>
</div>