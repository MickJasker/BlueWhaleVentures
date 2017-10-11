<div id="nav" class="row">

	<img id="logo" src="../../Main/Files/Images/logo.svg" class="col-md-1">


	<h4 id="left" class="col-md-2">
		Welcome, <span class="user">Startup</span>
	</h4>

	<div id="clientswitch" class="col-md-3">

		<h4>
			<span id="mentor">Mentor</span>
		</h4>

		<label class="switch">
			<input id="checkbox" onclick="selectclientormentor()" type="checkbox" checked>
			<span class="slider round"></span>
		</label>

		<h4>
			<span id="client" class="blue">Client</span>
		</h4>

	</div>
	<h4 id="right" class="col-md-2">
		<a href="">Home </a> <a href="">Profile</a> <a href="">Logout</a>
	</h4>
	<div class="input_fields col-md-4">
		<div class="filter">
			<input type="search" onclick="showFilter()" class="filterbtn" placeholder="Filter">
			<div id="content" class="filter-content">
				<a href="#">Games</a>
				<a href="#">Navigation</a>
				<a href="#">Fashion</a>
			</div>
		</div>

		<div id="searchdiv">

			<input type="search" id="searchbar" placeholder="Search for Experiment">

		</div>
	</div>



</div>