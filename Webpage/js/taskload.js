var taskdata = []; //siia salvestama taskide data, et popupi ajal kasutada
var taskID;
var boardName;

/*var isWindowLoaded2 = false;
Event.observe(window, 'load', function(){isWindowLoaded2 = true});

$.script("taskload.js").wait(function() {
   if (isWindowLoaded2) {
       alert("Olen lahe2.");
       loadTasks();
   }
    else {
       console.log("Taskload.js loadis on viga.");
   }
});*/

$(window).load(function () {
    loadTask();
    submitNewTask();
});

function loadTask() {
    $.ajax({
        type: "GET",
        url: "/include/showtasks.php",
        dataType: "json",
        data: {'boardURL': window.location.href},
        success: function (data) {
            taskdata.push.apply(taskdata, data);
            var url = window.location.href.split('?')[1];
            sessionStorage.setItem(url, JSON.stringify(data));
            addTime(data.length);
            $("div.boardpcontainer").empty();
            showBoards(data);
        },
        error: function() {
            var url = (window.location.href.split('?'))[1];
            var data = JSON.parse(sessionStorage.getItem(url));
            showBoards(data);
        }
    });
}

function showBoards(data) {
    console.log("Data: " + data);
    if (data.length != 0) {
        for (var i = 0; i < data.length; i++) {
            var p = document.createElement("p");
            p.textContent = JSON.stringify(data[i]["Name"]);
            p.id = "Task" + i;

            var id = data[i]["ID"];
            var boardname = data[i]["boardName"];

            var boardpcontainer = document.createElement("div");
            boardpcontainer.className = "boardpcontainer";

            if (data[i]["Task_Type"] == "ToDo") {
                document.body.getElementsByClassName("boardpcontainer").item(0).appendChild(p);
                p.addEventListener("click", showToDo.bind(null, p.textContent, id, boardname));
            }
            else if (data[i]["Task_Type"] == "Pending") {
                document.body.getElementsByClassName("boardpcontainer").item(1).appendChild(p);
                p.addEventListener("click", showPending.bind(null, p.textContent, id, boardname));
            }
            else if (data[i]["Task_Type"] == "Finished") {
                document.body.getElementsByClassName("boardpcontainer").item(2).appendChild(p);
                p.addEventListener("click", showFinish.bind(null, p.textContent, id, boardname));
            }
        }
    }
}

function showToDo(task, id, board) {
    var name;
    var status;
    var desc;
    var dueDate;
    var startDate;
    var endDate;
    var n = document.getElementsByTagName("tr").item(0).childNodes[1];
    var st = document.getElementsByTagName("tr").item(1).childNodes[1];
    var d = document.getElementsByTagName("tr").item(2).childNodes[1];
    var dDate = document.getElementsByTagName("tr").item(3).childNodes[1];
    var sd = document.getElementsByTagName("tr").item(4).childNodes[1];
    var ed = document.getElementsByTagName("tr").item(5).childNodes[1];

    for (var i = 0; i < taskdata.length; i++) {
        if (taskdata[i]["Name"] == task.replace(/[""]/g, '')) {
            taskID = id.replace(/[""]/g, '');
            boardName = board.replace(/[""]/g, '');

            if (!(typeof n == "undefined")) {
                n.textContent = null;
                d.textContent = null;
                dDate.textContent = null;
                st.textContent = null;
                sd.textContent = null;
                ed.textContent = null;

                div_show_start();

                n.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g, '');
                if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                    d.textContent = "";
                }
                else {
                    d.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                }

                newDate = new Date(JSON.stringify(taskdata[i]["dueDate"]));
                if (newDate.getMonth() < 9 || newDate.getDate() < 10) {
                    if (newDate.getMonth() < 9 && newDate.getDate() < 10) {
                        dDate.textContent = "0" + newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else if (newDate.getMonth() >= 9 && newDate.getDate() < 10) {
                        dDate.textContent = "0" + newDate.getDate() + "/" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else {
                        dDate.textContent = newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                }
                else {
                    dDate.textContent = newDate.getDate() + "/" + (newDate.getMonth() + 1) + "/" + newDate.getFullYear();
                }

                st.textContent = "Not started";
                sd.textContent = "N/A";
                ed.textContent = "N/A";

            } else {

                div_show_start();

                name = document.createElement("td");
                name.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g, '');

                desc = document.createElement("td");
                if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                    desc.textContent = "";
                }
                else {
                    desc.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                }

                dueDate = document.createElement("td");
                newDate = new Date(JSON.stringify(taskdata[i]["dueDate"]));
                if (newDate.getMonth() < 9 || newDate.getDate() < 10) {
                    if (newDate.getMonth() < 9 && newDate.getDate() < 10) {
                        dueDate.textContent = "0" + newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else if (newDate.getMonth() >= 9 && newDate.getDate() < 10) {
                        dueDate.textContent = "0" + newDate.getDate() + "/" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else {
                        dueDate.textContent = newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                }
                else {
                    dueDate.textContent = newDate.getDate() + "/" + (newDate.getMonth() + 1) + "/" + newDate.getFullYear();
                }

                status = document.createElement("td");
                status.textContent = "Not started";

                startDate = document.createElement("td");
                startDate.textContent = "N/A";

                endDate = document.createElement("td");
                endDate.textContent = "N/A";

                document.getElementsByTagName("tr").item(0).insertBefore(name, document.getElementsByTagName("tr").item(0).childNodes[2]);
                document.getElementsByTagName("tr").item(1).insertBefore(status, document.getElementsByTagName("tr").item(1).childNodes[2]);
                document.getElementsByTagName("tr").item(2).insertBefore(desc, document.getElementsByTagName("tr").item(2).childNodes[2]);
                document.getElementsByTagName("tr").item(3).insertBefore(dueDate, document.getElementsByTagName("tr").item(3).childNodes[2]);
                document.getElementsByTagName("tr").item(4).insertBefore(startDate, document.getElementsByTagName("tr").item(4).childNodes[2]);
                document.getElementsByTagName("tr").item(5).insertBefore(endDate, document.getElementsByTagName("tr").item(5).childNodes[2]);
            }
        }
    }
    //document.getElementById("form_popup").style.display = "block";
    //document.getElementById("popup_start").style.display = "block";
}

function showFinish(task, id, board) {
    var name;
    var status;
    var desc;
    var dueDate;
    var startDate;
    var endDate;
    var time;
    var n = document.getElementsByTagName("tr").item(15).childNodes[1];
    var st = document.getElementsByTagName("tr").item(16).childNodes[1];
    var d = document.getElementsByTagName("tr").item(17).childNodes[1];
    var dDate = document.getElementsByTagName("tr").item(18).childNodes[1];
    var sd = document.getElementsByTagName("tr").item(19).childNodes[1];
    var ed = document.getElementsByTagName("tr").item(20).childNodes[1];
    var t = document.getElementsByTagName("tr").item(21).childNodes[1];

    for (var i = 0; i < taskdata.length; i++) {
        if (taskdata[i]["Name"] == task.replace(/[""]/g, '')) {
            taskID = id.replace(/[""]/g, '');
            boardName = board.replace(/[""]/g, '');
            if (typeof n == "undefined") {

                name = document.createElement("td");
                name.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g, '');

                desc = document.createElement("td");
                if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                    desc.textContent = "";
                }
                else {
                    desc.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                }

                dueDate = document.createElement("td");
                newDate = new Date(JSON.stringify(taskdata[i]["dueDate"]));
                if (newDate.getMonth() < 9 || newDate.getDate() < 10) {
                    if (newDate.getMonth() < 9 && newDate.getDate() < 10) {
                        dueDate.textContent = "0" + newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else if (newDate.getMonth() >= 9 && newDate.getDate() < 10) {
                        dueDate.textContent = "0" + newDate.getDate() + "/" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else {
                        dueDate.textContent = newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                }
                else {
                    dueDate.textContent = newDate.getDate() + "/" + (newDate.getMonth() + 1) + "/" + newDate.getFullYear();
                }

                status = document.createElement("td");
                status.textContent = "Finished";

                startDate = document.createElement("td");
                newDateStart = new Date(JSON.stringify(taskdata[i]["startDate"]));
                if (newDateStart.getMonth() < 9 || newDateStart.getDate() < 10) {
                    if (newDateStart.getMonth() < 9 && newDateStart.getDate() < 10) {
                        startDate.textContent = "0" + newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else if (newDateStart.getMonth() >= 9 && newDateStart.getDate() < 10) {
                        startDate.textContent = "0" + newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else {
                        startDate.textContent = newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                }
                else {
                    startDate.textContent = newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1) + "/" + newDateStart.getFullYear();
                }

                endDate = document.createElement("td");
                newDateEnd = new Date(JSON.stringify(taskdata[i]["endDate"]));
                if (newDateEnd.getMonth() < 9 || newDateEnd.getDate() < 10) {
                    if (newDateEnd.getMonth() < 9 && newDateEnd.getDate() < 10) {
                        endDate.textContent = "0" + newDateEnd.getDate() + "/0" + (newDateEnd.getMonth() + 1)
                        + "/" + newDateEnd.getFullYear();
                    }
                    else if (newDateEnd.getMonth() >= 9 && newDateEnd.getDate() < 10) {
                        endDate.textContent = "0" + newDateEnd.getDate() + "/" + (newDateEnd.getMonth() + 1)
                        + "/" + newDateEnd.getFullYear();
                    }
                    else {
                        endDate.textContent = newDateEnd.getDate() + "/0" + (newDateEnd.getMonth() + 1)
                        + "/" + newDateEnd.getFullYear();
                    }
                }
                else {
                    endDate.textContent = newDateEnd.getDate() + "/" + (newDateEnd.getMonth() + 1) + "/" + newDateEnd.getFullYear();
                }

                time = document.createElement("td");
                time.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g, '') + " seconds";

                document.getElementsByTagName("tr").item(15).insertBefore(name, document.getElementsByTagName("tr").item(15).childNodes[2]);
                document.getElementsByTagName("tr").item(16).insertBefore(status, document.getElementsByTagName("tr").item(16).childNodes[2]);
                document.getElementsByTagName("tr").item(17).insertBefore(desc, document.getElementsByTagName("tr").item(17).childNodes[2]);
                document.getElementsByTagName("tr").item(18).insertBefore(dueDate, document.getElementsByTagName("tr").item(18).childNodes[2]);
                document.getElementsByTagName("tr").item(19).insertBefore(startDate, document.getElementsByTagName("tr").item(19).childNodes[2]);
                document.getElementsByTagName("tr").item(20).insertBefore(endDate, document.getElementsByTagName("tr").item(20).childNodes[2]);
                document.getElementsByTagName("tr").item(21).insertBefore(time, document.getElementsByTagName("tr").item(21).childNodes[2]);

            }
            else {
                n.textContent = null;
                d.textContent = null;
                dDate.textContent = null;
                st.textContent = null;
                sd.textContent = null;
                ed.textContent = null;
                t.textContent = null;

                n.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g, '');
                if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                    d.textContent = "";
                }
                else {
                    d.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                }

                newDate = new Date(JSON.stringify(taskdata[i]["dueDate"]));
                if (newDate.getMonth() < 9 || newDate.getDate() < 10) {
                    if (newDate.getMonth() < 9 && newDate.getDate() < 10) {
                        dDate.textContent = "0" + newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else if (newDate.getMonth() >= 9 && newDate.getDate() < 10) {
                        dDate.textContent = "0" + newDate.getDate() + "/" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else {
                        dDate.textContent = newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                }
                else {
                    dDate.textContent = newDate.getDate() + "/" + (newDate.getMonth() + 1) + "/" + newDate.getFullYear();
                }
                newDateStart = new Date(JSON.stringify(taskdata[i]["startDate"]));
                if (newDateStart.getMonth() < 9 || newDateStart.getDate() < 10) {
                    if (newDateStart.getMonth() < 9 && newDateStart.getDate() < 10) {
                        sd.textContent = "0" + newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else if (newDateStart.getMonth() >= 9 && newDateStart.getDate() < 10) {
                        sd.textContent = "0" + newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else {
                        sd.textContent = newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                }
                else {
                    sd.textContent = newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1) + "/" + newDateStart.getFullYear();
                }

                newDateEnd = new Date(JSON.stringify(taskdata[i]["endDate"]));
                if (newDateEnd.getMonth() < 9 || newDateEnd.getDate() < 10) {
                    if (newDateEnd.getMonth() < 9 && newDateEnd.getDate() < 10) {
                        ed.textContent = "0" + newDateEnd.getDate() + "/0" + (newDateEnd.getMonth() + 1)
                        + "/" + newDateEnd.getFullYear();
                    }
                    else if (newDateEnd.getMonth() >= 9 && newDateEnd.getDate() < 10) {
                        ed.textContent = "0" + newDateEnd.getDate() + "/" + (newDateEnd.getMonth() + 1)
                        + "/" + newDateEnd.getFullYear();
                    }
                    else {
                        ed.textContent = newDateEnd.getDate() + "/0" + (newDateEnd.getMonth() + 1)
                        + "/" + newDateEnd.getFullYear();
                    }
                }
                else {
                    ed.textContent = newDateEnd.getDate() + "/" + (newDateEnd.getMonth() + 1) + "/" + newDateEnd.getFullYear();
                }
                st.textContent = "Finished";
                t.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g, '') + " seconds";
            }
        }
    }

    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_finish").style.display = "block";
}

function showPending(task, id, board) {
    var name;
    var status;
    var desc;
    var dueDate;
    var startDate;
    var endDate;
    var time;
    var n = document.getElementsByTagName("tr").item(7).childNodes[1];
    var st = document.getElementsByTagName("tr").item(8).childNodes[1];
    var d = document.getElementsByTagName("tr").item(9).childNodes[1];
    var dDate = document.getElementsByTagName("tr").item(10).childNodes[1];
    var sd = document.getElementsByTagName("tr").item(11).childNodes[1];
    var ed = document.getElementsByTagName("tr").item(12).childNodes[1];
    var t = document.getElementsByTagName("tr").item(13).childNodes[1];

    for (var i = 0; i < taskdata.length; i++) {
        if (taskdata[i]["Name"] == task.replace(/[""]/g, '')) {
            taskID = id.replace(/[""]/g, '');
            boardName = board.replace(/[""]/g, '');
            if (typeof n == "undefined") {

                name = document.createElement("td");
                name.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g, '');

                desc = document.createElement("td");
                if (JSON.stringify(taskdata[i]["Description"]) != "null") {
                    desc.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                } else {
                    desc.textContent = "";
                }

                dueDate = document.createElement("td");
                newDate = new Date(JSON.stringify(taskdata[i]["dueDate"]));
                if (newDate.getMonth() < 9 || newDate.getDate() < 10) {
                    if (newDate.getMonth() < 9 && newDate.getDate() < 10) {
                        dueDate.textContent = "0" + newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else if (newDate.getMonth() >= 9 && newDate.getDate() < 10) {
                        dueDate.textContent = "0" + newDate.getDate() + "/" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else {
                        dueDate.textContent = newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                }
                else {
                    dueDate.textContent = newDate.getDate() + "/" + (newDate.getMonth() + 1) + "/" + newDate.getFullYear();
                }

                status = document.createElement("td");
                status.textContent = "Pending";

                startDate = document.createElement("td");
                newDateStart = new Date(JSON.stringify(taskdata[i]["startDate"]));
                if (newDateStart.getMonth() < 9 || newDateStart.getDate() < 10) {
                    if (newDateStart.getMonth() < 9 && newDateStart.getDate() < 10) {
                        startDate.textContent = "0" + newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else if (newDateStart.getMonth() >= 9 && newDateStart.getDate() < 10) {
                        startDate.textContent = "0" + newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else {
                        startDate.textContent = newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                }
                else {
                    startDate.textContent = newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1) + "/" + newDateStart.getFullYear();
                }

                endDate = document.createElement("td");
                endDate.textContent = "N/A";

                time = document.createElement("td");
                time.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g, '') + " seconds";

                document.getElementsByTagName("tr").item(7).insertBefore(name, document.getElementsByTagName("tr").item(7).childNodes[2]);
                document.getElementsByTagName("tr").item(8).insertBefore(status, document.getElementsByTagName("tr").item(8).childNodes[2]);
                document.getElementsByTagName("tr").item(9).insertBefore(desc, document.getElementsByTagName("tr").item(9).childNodes[2]);
                document.getElementsByTagName("tr").item(10).insertBefore(dueDate, document.getElementsByTagName("tr").item(10).childNodes[2]);
                document.getElementsByTagName("tr").item(11).insertBefore(startDate, document.getElementsByTagName("tr").item(11).childNodes[2]);
                document.getElementsByTagName("tr").item(12).insertBefore(endDate, document.getElementsByTagName("tr").item(12).childNodes[2]);
                document.getElementsByTagName("tr").item(13).insertBefore(time, document.getElementsByTagName("tr").item(13).childNodes[2]);

            }
            else {
                n.textContent = null;
                d.textContent = null;
                dDate.textContent = null;
                st.textContent = null;
                sd.textContent = null;
                ed.textContent = null;
                t.textContent = null;

                n.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g, '');
                if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                    d.textContent = "";
                }
                else {
                    d.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                }

                newDate = new Date(JSON.stringify(taskdata[i]["dueDate"]));
                if (newDate.getMonth() < 9 || newDate.getDate() < 10) {
                    if (newDate.getMonth() < 9 && newDate.getDate() < 10) {
                        dDate.textContent = "0" + newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else if (newDate.getMonth() >= 9 && newDate.getDate() < 10) {
                        dDate.textContent = "0" + newDate.getDate() + "/" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                    else {
                        dDate.textContent = newDate.getDate() + "/0" + (newDate.getMonth() + 1)
                        + "/" + newDate.getFullYear();
                    }
                }
                else {
                    dDate.textContent = newDate.getDate() + "/" + (newDate.getMonth() + 1) + "/" + newDate.getFullYear();
                }

                st.textContent = "Pending";

                sd = document.createElement("td");
                newDateStart = new Date(JSON.stringify(taskdata[i]["startDate"]));
                if (newDateStart.getMonth() < 9 || newDateStart.getDate() < 10) {
                    if (newDateStart.getMonth() < 9 && newDateStart.getDate() < 10) {
                        sd.textContent = "0" + newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else if (newDateStart.getMonth() >= 9 && newDateStart.getDate() < 10) {
                        sd.textContent = "0" + newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                    else {
                        sd.textContent = newDateStart.getDate() + "/0" + (newDateStart.getMonth() + 1)
                        + "/" + newDateStart.getFullYear();
                    }
                }
                else {
                    sd.textContent = newDateStart.getDate() + "/" + (newDateStart.getMonth() + 1) + "/" + newDateStart.getFullYear();
                }
                ed.textContent = "N/A";
                t.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g, '') + " seconds";
            }
        }
    }

    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_pending").style.display = "block";
}

function div_hide_start() {
    document.getElementsByTagName("tr").item(0).childNodes[1].textContent = null;
    document.getElementsByTagName("tr").item(1).childNodes[1].textContent = null;
    document.getElementsByTagName("tr").item(2).childNodes[1].textContent = null;
    document.getElementsByTagName("tr").item(3).childNodes[1].textContent = null;
    document.getElementsByTagName("tr").item(4).childNodes[1].textContent = null;
    document.getElementsByTagName("tr").item(5).childNodes[1].textContent = null;
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_start").style.display= "none";
}

function div_show_start() {
    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_start").style.display = "block";
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

function taskURL() {
    return taskID;
}

function boardURL () {
    return boardName;
}

function submitNewTask() {
    $('#form_newtask').submit(function (e) {
        e.preventDefault();

        var data = $(this).serialize();
        console.log("Data: " + data);
        console.log("E: " + e);
        var url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function () {
                document.getElementById("form_popup").style.display = "none";
                document.getElementById("popup_newdesc").style.display = "none";
            },
            error: function () {
                console.log("submitNewTask.js viga.");
            }
        });
    });
}

function addTime(len) {
    if (typeof window.sessionStorage != "undefined" && len != 0) {
        for (var i = 0; i < sessionStorage.length; i++) {
            if (sessionStorage.key(i).match(/pauseTime?/i) || sessionStorage.key(i).match(/stopTime?/i)) {
                var urlLopp = sessionStorage.key(i).split('?')[1];
                var t = sessionStorage.getItem(sessionStorage.key(i));
                var url = window.location.href.split('?')[0] + '?' + urlLopp;
                if (sessionStorage.key(i).match(/pauseTime?/i)) {
                    $.ajax({
                        type: "GET",
                        url: "include/addTime.php",
                        data: {'taskURL': url, 'taskTime': t, 'type': 'pause'},
                        success: function () {
                            console.log("Added time in pause.");
                        }
                    });
                }
                else {
                    $.ajax({
                        type: "GET",
                        url: "include/addTime.php",
                        data: {'taskURL': url, 'taskTime': t, 'type': 'stop'},
                        success: function () {
                            console.log("Added time in stop.");
                        }
                    });
                }
                sessionStorage.removeItem(sessionStorage.key(i));
            }
        }
    }
}