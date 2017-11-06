//timeline
window.onload = function() {
    var elem = document.getElementById("bar");
    var width = 1;
    var id = setInterval(frame, 30);
    function frame() {
        var currentDay = document.getElementById("currentday").innerHTML;
        if (width >= currentDay) {
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