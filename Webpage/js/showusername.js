//If page loads, it displays the right username
$(function () {
    $.ajax({
        type: "GET",
        url: "/include/username.php",
        success: function (msg) {
            document.getElementById("account").innerHTML = msg;
        }
    });
});