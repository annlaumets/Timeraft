//If page loads, it displays the right username
$(function () {
    $.ajax({
        type: "GET",
        url: "/include/username.php",
        success: function (msg) {
            document.getElementById("account").innerHTML = msg;
        }
    });
    if (!!document.getElementById("datepick")) {
        var pickerOpts = {
            dateFormat:"dd/mm/yy",
            minDate: 0
        };
        $("#datepick").datepicker(pickerOpts); //datepicker for due date in create task
    };
});