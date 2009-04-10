$(document).ready(function() {
    $("tr.str:nth-child(odd)").addClass("odd");
    $("tr.str:nth-child(even)").addClass("even");
    $("input[@type='text']").css("width","100");
});

function showNewName(pos) {
    //$('#newname'+pos+':visible').length>0 ? $("#newname"+pos).slideUp("fast") : $("#newname"+pos).slideDown("fast");
    $("#newname"+pos).slideToggle("fast", function() { 
        $("#tmblr"+pos).text($("#tmblr"+pos).text()=="↑" ? "↓" : "↑"); 
    });
}