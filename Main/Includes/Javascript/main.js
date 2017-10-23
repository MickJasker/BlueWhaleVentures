//Navbar
function showFilter() {
    document.getElementById("content").classList.toggle("show");
}


function selectclientormentor(){

    var client = document.getElementById("client");
    var mentor = document.getElementById("mentor");

    mentor.classList.toggle("blue");
    client.classList.toggle("blue");

    if(client.className === 'blue'){

        $.get("client.php", function( data ){
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(1300);
                console.log('client');
            });
        });
    }else {

        $.get("mentor.php", function( data ) {
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(1300);
                console.log('mentor');
            });
        });
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