<div id="nav">

	<img id="logo" src="../../Main/Files/Images/logo.svg" class="col-md-1">


	<h4 id="left" class="col-md-2">
		Welcome, <span class="user">Admin</span>
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
	<h4 id="right" class="col-md-2">
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/index.php">Home </a>
		<a href="../../<?php echo $_SESSION['Role'];?>_Portal/Pages/Profile.php">Profile</a>
		<a href="../Main/Pages/logout.php">Logout</a>
	</h4>
</div>