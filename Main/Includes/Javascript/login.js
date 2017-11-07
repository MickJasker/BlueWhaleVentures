window.onload = function (){
    var ar = ['adminbackground.jpg', 'background2.jpg', 'background3.jpg'];
    var main = document.getElementById("main");
    var number = 0;
    var background = 'url(Main/Files/Images/stockImages/' + ar[number] + ')';
    main.style.backgroundImage = background;

    setTimeout(number = number + 1, 4000);
};