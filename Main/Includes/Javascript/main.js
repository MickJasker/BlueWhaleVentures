//Navbar
function showFilter() {
    document.getElementById("content").classList.toggle("show");
}


function selectclientormentor(){

    var classclient = document.getElementById("client");
    var classmentor = document.getElementById("mentor");
    var mentor = $.get("mentor.php", function( data ) {
        $( '#wrapper-admin' ).html( data );});
    var client = $.get("client.php", function( data ){
        $( '#wrapper-admin' ).html( data );});

    classmentor.classList.toggle("blue");
    classclient.classList.toggle("blue");

    if(classclient.className == 'blue'){

        $("#wrapper-admin").html(mentor);
        console.log(classclient.className);


    }else if(classclient.className != 'blue'){

        $("#wrapper-admin").html(client);
        console.log(classclient.className);

    }
}

window.onclick = function(event) {
    if (!event.target.matches('.filterbtn')) {
        var dropdowns = document.getElementsByClassName("filter-content");
        var i;
        for (i = 0; i < dropdowns.length; i++){
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
};