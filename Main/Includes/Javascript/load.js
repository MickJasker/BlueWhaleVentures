window.onload = function () {
    $('body').fadeIn(300);
    $.get("client.php", function( data ) {
        $( '#wrapper-admin' ).html( data );
    });
}