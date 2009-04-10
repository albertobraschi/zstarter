$(document).ready(function() {
    $("tr.str:nth-child(odd)").addClass("odd");
    $("tr.str:nth-child(even)").addClass("even");
    //$("input[@type='text']").css("width","100");

    $("div#left_toolbar").click(function () {
        //$("div#left_menu").hide("slide", { direction: "right" }, 1000);
        if (!$("div#left_menu").is(":hidden")) {
            $("div#left_menu").slideUp("slow", function() {
                $("div#menu").animate({"width": "20px"}, "slow");
                $("div#top, div#main, div#bottom").animate({"marginLeft": "20px"}, "slow");
            });
        } else {
            $("div#menu").animate({"width": "230px"}, "slow", function() {
                $("div#left_menu").slideDown("slow");
            });
            $("div#top, div#main, div#bottom").animate({"marginLeft": "250px"}, "slow");
        }
    });
});

function menuToogle(id) {
    $('div#sub'+id).slideToggle("fast");
}