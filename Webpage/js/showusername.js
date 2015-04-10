//If page loads, it displays the right username
$(function () {
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