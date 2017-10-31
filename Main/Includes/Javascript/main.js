//timeline
window.onload = function() {
    var elem = document.getElementById("bar");
    var width = 1;
    var id = setInterval(frame, 30);
    function frame() {
        if (width >= 66) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';

            //animatie groter worden bolletjes
            var milestone = document.getElementsByClassName("milestone");
            if(width >= "100"){
                if(milestone[4].className === "milestone right"){
                    milestone[3].style.left = "-20px";
                    milestone[2].style.left = "-15px";
                    milestone[1].style.left = "-5px";

                    milestone[4].id = "grow";
                    milestone[3].id = "grow";
                    milestone[2].id = "grow";
                    milestone[1].id = "grow";
                }
            }
            else if(width >= "75"){
                if(milestone[3].className === "milestone left2"){
                    milestone[3].style.left = "-25px";
                    milestone[2].style.left = "-15px";
                    milestone[1].style.left = "-5px";

                    milestone[3].id = "grow";
                    milestone[2].id = "grow";
                    milestone[1].id = "grow";
                }
            }
            else if(width >= "50"){
                if(milestone[2].className === "milestone left2"){
                    milestone[3].style.left = "-25px";
                    milestone[2].style.left = "-15px";
                    milestone[1].style.left = "-5px";

                    milestone[2].id = "grow";
                    milestone[1].id = "grow";
                }
            }
            else if(width >= "25"){
                if(milestone[1].className === "milestone left1"){
                    milestone[3].style.left = "-25px";
                    milestone[2].style.left = "-15px";
                    milestone[1].style.left = "-5px";

                    milestone[1].id = "grow";
                }
            }
        }
    }
};

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

            if (target === a) {
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