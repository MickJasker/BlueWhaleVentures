window.onload(function(){
    var experiments = document.getElementById("experiments");
    var bachelors = document.getElementById("bachelors");
    var searchbar = document.getElementById("searchbar");

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
                searchbar.placeholder = "Search for Startup";
            });
        });
    }
});