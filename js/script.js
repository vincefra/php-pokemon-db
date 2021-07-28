//metoder för ladda olika iframes, oanvänd
function showUsers() {
    var iframe = $("#postShowUsers");
    iframe.attr("src", iframe.data("src"));
}

function showItems() {
    var iframe = $("#postShowItems");
    iframe.attr("src", iframe.data("src"));
}

function showLoans() {
    var iframe = $("#postShowLoans");
    iframe.attr("src", iframe.data("src"));
}

//fångar klicks, ladda iframes till olika sidor
$("#buttonUsers").click(function () {
    $("#iframe").attr("src", "crud/dbfetch.php");
});

$("#buttonItems").click(function () {
    $("#iframe").attr("src", "crud/dbadd.php");
});

$("#buttonLoans").click(function () {
    $("#iframe").attr("src", "crud/dbdel.php");
});

function hideFrames() {
    $("#postShowUsers").hide();
}