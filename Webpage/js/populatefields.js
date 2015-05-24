/**
 * Created by ViktoriaP on 24.05.2015.
 */
$(window).load(function() {
    $.ajax({
        type: "GET",
        url: "/include/showaccount.php",
        dataType: "json",
        data: {settings: true},
        success: function (data) {
            console.log(data);
            document.getElementById("nameID").value = data['Name'];
            if (data['Bio'] != null) {
                document.getElementById("bioID").value = data['Bio'];
            }
        }
    })
});