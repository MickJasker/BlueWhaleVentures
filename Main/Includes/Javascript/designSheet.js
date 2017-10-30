$(".switchButton1").click(function () {
    var active = this.classList[1];
    if (active != "switchActive") {
        $(".switchButton1").addClass("switchActive");
        $(".switchButton2").removeClass("switchActive");
        $("form").fadeIn(300);
    }
});
$(".switchButton2").click(function () {
    var active = this.classList[1];
    if (active != "switchActive") {
        $(".switchButton2").addClass("switchActive");
        $(".switchButton1").removeClass("switchActive");
    }
});

