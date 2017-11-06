
//Navbar
//client/mentorswitch
function selectclientormentor(){

    var client = document.getElementById("client");
    var mentor = document.getElementById("mentor");
    var searchbar = document.getElementById("searchbar");

    //verander de kleur vd letters als de knop ingedrukt wordt
    mentor.classList.toggle("blue");
    client.classList.toggle("blue");

    //Als client geselecteerd is laad client.php in de body
    if(client.className === 'blue'){

        $.get("client.php", function( data ){
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(500);
                searchbar.placeholder = "Search for Client";
            });
        });

    //Als mentor geselecteerd is laad mentor.php in de body
    }else if(mentor.className === 'blue'){

        $.get("mentor.php", function( data ) {
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(500);
                searchbar.placeholder = "Search for Mentor";
            });
        });
    }
}

//experiment/bachelorswitch
function selectexpbachelor(){

    var experiments = document.getElementById("experiments");
    var bachelors = document.getElementById("bachelors");
    var searchbar = document.getElementById("searchbar");

    //verander de kleur vd letters als de knop ingedrukt wordt
    bachelors.classList.toggle("blue");
    experiments.classList.toggle("blue");

    //Als client geselecteerd is laad client.php in de body
    if(experiments.className === 'blue'){

        $.get("experiments.php", function( data ){
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(500);
                searchbar.placeholder = "Search for Experiment";
            });
        });

        //Als mentor geselecteerd is laad mentor.php in de body
    }else if(bachelors.className === 'blue'){

        $.get("bachelors.php", function( data ) {
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(500);
                searchbar.placeholder = "Search for Group";
            });
        });
    }
}

function selectclient(){

    var client = document.getElementById("clients");
    var bachelor = document.getElementById("bachelor");
    var bar = client.borderBottom;

    //Als client geselecteerd is laad client.php in de body
    if(client.className === 'border-bottom'){

        //Als bachelor geselecteerd is laad bachelor.php in de body
    }else{
        bachelor.classList.toggle("border-bottom");
        client.classList.toggle("border-bottom");
        $.get("client.php", function( data ){
            $('.list').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('.list').fadeIn(500);
            });
        });
    }
}

function selectbachelor() {

    var client = document.getElementById("clients");
    var bachelor = document.getElementById("bachelor");
    var bar = client.borderBottom;

    //Als client geselecteerd is laad client.php in de body
    if (bachelor.className === 'border-bottom') {

        //Als bachelor geselecteerd is laad bachelor.php in de body
    } else {
        bachelor.classList.toggle("border-bottom");
        client.classList.toggle("border-bottom");
        $.get("bachelors.php", function (data) {
            $('.list').fadeOut(500, function () {
                $('#wrapper-admin').html(data);
                $('.list').fadeIn(500);
            });
        });
    }
}

//filterfunctie
function filterfunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("input");
    filter = input.value.toUpperCase();
    ul = document.getElementById("content");
    li = ul.getElementsByTagName("li");
    var text = document.getElementById('input').value;

    //als er elementen in de dropdown zitten die overeenkomen met de getypte tekst laat die zien
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }

    //als er tekst in de zoekbalk staat laat de dropdown elementen zien
    if(text != ""){
        document.getElementById("content").classList.add("show");
    }else if(text == ""){
        document.getElementById("content").classList.remove("show");
    }

    list = document.getElementsByClassName("content")[0];
    listitem = list.getElementsByTagName("li");
    if (input.value === ""){

        for(i = 0; i < listitem.length; i++){
            listitem[i].style.display = "";
        }
    }
}

//filter op klik functie
function getEventTarget(e) {
    e = e || window.event;
    return e.target || e.srcElement;
}

function filterclick(){
    //verkrijg de geselecteerde tekst
    var input = document.getElementById("content");
    input.onclick = function(event) {
        //zet de geselecteerde tekst in variabel en maak hoofdletters
        var target = getEventTarget(event).innerHTML.toUpperCase();

        ul = document.getElementsByClassName("list")[0];
        li = ul.getElementsByTagName("li");

        for (i = 0; i < li.length; i++) {
            a = li[i].classList[0].toUpperCase();
            //zorgt ervoor dat alle _ vervangen worden door spaties
            var b = a.split("_").join(" ");
            console.log(b);
            console.log(target);

            if (target === b) {
                li[i].style.display = "";
            }else {
                li[i].style.display = "none";
            }
        }
    };
}


//zoekbalk functie
function searchbarfunction(){
    var input, filter, ul, li, a, i;
    input = document.getElementById("searchbar");
    filter = input.value.toUpperCase();
    ul = document.getElementsByClassName("list")[0];
    li = ul.getElementsByTagName("li");

    //als de getypte tekst overeenkomt met een h1 van de ul laat deze zien, de rest niet
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("h1")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

//add client form
function createcompany(){

    var modal = document.getElementById('clientform');
    var span = document.getElementsByClassName("close")[0];

    //als je op de knop add client drukt verschijnt de form
        modal.style.display = "block";

    // als je op het kruisje drukt sluit het element
    span.onclick = function() {
        modal.style.display = "none";
    }

    //als je buiten het element klikt sluit het element
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

//add mentor form
function creatementor(){

    var modal = document.getElementById('mentorform');
    var span = document.getElementsByClassName("close")[0];

    //als je op de knop add mentor drukt verschijnt de form
        modal.style.display = "block";

    //als je op het kruisje drukt sluit het element
    span.onclick = function() {
        modal.style.display = "none";
    }

    // als je buiten het element klikt sluit het
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

//assign mentor form
function assignMentor(){

    var modal = document.getElementById('mentormodal');
    var span = document.getElementsByClassName("close")[0];

    //als je op de knop add mentor drukt verschijnt de form
    modal.style.display = "block";

    //als je op het kruisje drukt sluit het element
    span.onclick = function() {
        modal.style.display = "none";
    }

    // als je buiten het element klikt sluit het
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}