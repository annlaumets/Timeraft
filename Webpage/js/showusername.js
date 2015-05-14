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
            var name = "";
            var i = 0;
            while (msg[i] != "<") {
                name += (msg[i]);
                i++;
            }
            sessionStorage.setItem("UserName", name);
            document.getElementById("account").innerHTML = name.replace(/[""]/g, '') + msg.substring(i);
        },
        error: function() {
            document.getElementById("account").innerHTML = sessionStorage.getItem("UserName") + '<ul><li><a href="/account.php">PROFILE</a></li>' +
            '<li><a href="/settings.php">SETTINGS</a></li><li><a href="/stats.php" id="stats">STATISTICS</a></li><hr>' +
            '<li><a href="/include/logout.php" id="logoutBtn">LOG OUT</a></li></ul>';
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