window.onload(function(){
    var client = document.getElementById("client");
    var mentor = document.getElementById("mentor");
    var searchbar = document.getElementById("searchbar");

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
});