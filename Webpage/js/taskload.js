var taskdata = []; //siia salvestama taskide data, et popupi ajal kasutada

$(window).load(function () {
    $.ajax({
        type: "GET",
        url: "/include/showtasks.php",
        dataType: "json",
        data: {'boardURL': window.location.href},
        success: function (data) {
            if (data.length != 0) {
                taskdata.push(data);
                console.log(taskdata[0]);
                for (var i = 0; i < data.length; i++) {
                    var p = document.createElement("p");
                    p.textContent = JSON.stringify(taskdata[0][i]["Name"]);
                    console.log(taskdata[0][i]["Task_Type"]);

                    if (taskdata[0][i]["Task_Type"] == "ToDo") {
                        p.addEventListener("click", function () { //popupid on veel tegemata
                            console.log("Vajutasin todo-s.");
                            document.getElementById("form_popup").style.display = "block";
                            document.getElementById("popup_start").style.display = "block";
                        });
                        document.body.getElementsByClassName("boardpcontainer").item(0).appendChild(p);
                    }
                    else if (taskdata[0][i]["Task_Type"] == "Pending") {
                        p.addEventListener("click", function () { //popupid on veel tegemata
                            console.log("Vajutasin pending'us.");
                            document.getElementById("form_popup").style.display = "block";
                            document.getElementById("popup_pending").style.display = "block";
                        });
                        document.body.getElementsByClassName("boardpcontainer").item(1).appendChild(p);
                    }
                    else if (taskdata[0][i]["Task_Type"] == "Finished") {
                        p.addEventListener("click", function () { //popupid on veel tegemata
                            console.log("Vajutasin finishis.");
                            document.getElementById("form_popup").style.display = "block";
                            document.getElementById("popup_finish").style.display = "block";
                        });
                        document.body.getElementsByClassName("boardpcontainer").item(2).appendChild(p);
                    }
                }
            }
        }
    });

});

function div_hide_start() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_start").style.display= "none";
}

function div_hide_pending() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_pending").style.display= "none";
}

function div_hide_finished() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_finish").style.display= "none";
}

function div_hide_new() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_newdesc").style.display= "none";
}

function div_show_new() {
    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_newdesc").style.display= "block";
}