var taskdata = {}; //siia salvestama taskide data, et popupi ajal kasutada

$(window).load(function () {
    $.ajax({
        type: "GET",
        url: "/include/showtasks.php",
        dataType: "json",
        success: function (data) {
            if (data.length != 0) {
                taskdata.data = data;

                for (var i = 0; i < data.length; i++) {
                    var p = document.createElement("p");
                    p.textContent = JSON.stringify(data[i]["Name"]);
                    p.addEventListener("click", function () { //popupid on veel tegemata
                        document.getElementById("form_signin").style.display = "block";
                        document.getElementById("popup_desc").style.display = "block";

                    });

                    if (data[i]["Type"] == "To Do") {
                        document.body.getElementsByClassName("boardpcontainer").item(0).appendChild(p);
                    }
                    else if (data[i]["Type"] == "Pending") {
                        document.body.getElementsByClassName("boardpcontainer").item(1).appendChild(p);
                    }
                    else if (data[i]["Type"] == "Finished") {
                        document.body.getElementsByClassName("boardpcontainer").item(2).appendChild(p);
                    }
                }
            }
        }
    });

});

function div_hide() {
    document.getElementById("form_signin").style.display = "none";
    document.getElementById("popup_desc").style.display= "none";
}