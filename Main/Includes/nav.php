<div id="nav">

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

			<input onkeyup="filterfunction()" id="input" type="text" class="filterbtn" placeholder="Filter">

            <ul id="content" class="filter-content">
                <li><a href="#" onclick="showhtml()">Games</a></li>
                <li><a href="#" onclick="showhtml()">Navigation</a></li>
                <li><a href="#" onclick="showhtml()">Fashion</a></li>
            </ul>

		</div>

		<div id="searchdiv">

			<input onkeyup="searchbarfunction()" type="text" id="searchbar" placeholder="Search for Experiment">

		</div>
	</div>
</div>