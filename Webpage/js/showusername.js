//If page loads, it displays the right username
/*var isWindowLoaded3 = false;
Event.observe(window, 'load', function() {isWindowLoaded3 = true});

$.script("showusername.js").wait(function() {
    if (isWindowLoaded3) {
        loadUsername();
    }
    else {
        console.log("Showusername.js loadis on viga.");
    }
});*/

$(window).load(function () {
    $.ajax({
        type: "GET",
        url: "/include/username.php",
        success: function (msg) {
            sessionStorage.setItem("UserName", msg);
            document.getElementById("account2").innerHTML += msg;
            document.getElementById("account").innerHTML += msg;
        },
        error: function() {
            document.getElementById("account2").innerHTML += sessionStorage.getItem("UserName");
            document.getElementById("account").innerHTML += sessionStorage.getItem("UserName");
        }
    });
    if (!!document.getElementById("datepick")) {
        $("#datepick").datepicker({
            dateFormat: "dd/mm/yy",
            minDate: 0,
            changeMonth: true,
            changeYear: true
        });
    }
});