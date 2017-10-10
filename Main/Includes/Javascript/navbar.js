//Navbar

function showFilter() {
    document.getElementById("content").classList.toggle("show");
}

function selectclientormentor(){
    document.getElementById("mentor").classList.toggle("blue");
    document.getElementById("client").classList.toggle("blue");
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



