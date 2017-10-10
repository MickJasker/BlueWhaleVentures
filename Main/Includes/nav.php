<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/main.css">
</head>

<body id="wrapper-nav">
    <main>

        <div id="nav">

            <img id="logo" src="../Files/Images/logo.svg">


            <h4 id="left">
                Welcome, <span class="user">Startup</span>
            </h4>

                <div id="clientswitch">

                    <h4>
                        <span id="mentor">Mentor</span>
                    </h4>

                    <label class="switch">
                        <input onclick="selectclientormentor()" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>

                    <h4>
                        <span id="client" class="blue">Client</span>
                    </h4>

                </div>

            <div id="searchdiv">

                <input type="search" id="searchbar" placeholder="Search for Experiment">

            </div>

            <div class="filter">
                <input type="search" onclick="showFilter()" class="filterbtn" placeholder="Filter">
                <div id="content" class="filter-content">
                    <a href="#">Games</a>
                    <a href="#">Navigation</a>
                    <a href="#">Fashion</a>
                </div>
            </div>

            <h4 id="right">
                <a href="" >Home </a> <a href="" >Profile</a> <a href="">Logout</a>
            </h4>

        </div>


    </main>

    <script src="Javascript/navbar.js"></script>
</body>
</html>