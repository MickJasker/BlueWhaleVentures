//Navbar
function selectclientormentor(){

    var client = document.getElementById("client");
    var mentor = document.getElementById("mentor");

    mentor.classList.toggle("blue");
    client.classList.toggle("blue");

    if(client.className === 'blue'){

        $.get("client.php", function( data ){
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(500);
            });
        });
    }else if(mentor.className === 'blue'){

        $.get("mentor.php", function( data ) {
            $('#wrapper-admin').fadeOut(500, function(){
                $('#wrapper-admin' ).html( data );
                $('#wrapper-admin').fadeIn(500);
            });
        });
    }
}


function filterfunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("input");
    filter = input.value.toUpperCase();
    ul = document.getElementById("content");
    li = ul.getElementsByTagName("li");
    var input = document.getElementById('input').value;

    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }

    if(input != ""){
        document.getElementById("content").classList.add("show");
        console.log(input);
    }else if(input == ""){
        document.getElementById("content").classList.remove("show");
    }
}