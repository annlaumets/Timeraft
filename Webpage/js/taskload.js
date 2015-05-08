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
            taskdata.length = 0;
            taskdata.push.apply(taskdata, data);
            console.log("Data2: " + taskdata);
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

                n.textContent = taskdata[i]["Name"];
                if (taskdata[i]["Description"] == "null") {
                    d.textContent = "";
                }
                else {
                    d.textContent = taskdata[i]["Description"];
                }

                dDate.textContent = taskdata[i]["dueDate"];
                st.textContent = "Not started";
                sd.textContent = "N/A";
                ed.textContent = "N/A";

            } else {

                div_show_start();

                name = document.createElement("td");
                name.textContent = taskdata[i]["Name"];

                desc = document.createElement("td");
                if (taskdata[i]["Description"] == "null") {
                    desc.textContent = "";
                }
                else {
                    desc.textContent = taskdata[i]["Description"];
                }

                dueDate = document.createElement("td");
                dueDate.textContent = taskdata[i]["dueDate"];

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
            break
        }
    }
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
            if (!(typeof n == "undefined")) {
                n.textContent = null;
                d.textContent = null;
                dDate.textContent = null;
                st.textContent = null;
                sd.textContent = null;
                ed.textContent = null;
                t.textContent = null;

                div_show_finished();

                n.textContent = taskdata[i]["Name"];

                if (taskdata[i]["Description"] == "null") {
                    d.textContent = "";
                }
                else {
                    d.textContent = taskdata[i]["Description"];
                }

                dDate.textContent = taskdata[i]["dueDate"];
                sd.textContent = taskdata[i]["startDate"];
                ed.textContent = taskdata[i]["endDate"];
                st.textContent = "Finished";
                t.textContent = taskdata[i]["Task_Time"] + " seconds";
            } else {
                div_show_finished();

                name = document.createElement("td");
                name.textContent = taskdata[i]["Name"];

                desc = document.createElement("td");
                if (taskdata[i]["Description"] == "null") {
                    desc.textContent = "";
                }
                else {
                    desc.textContent = taskdata[i]["Description"];
                }

                dueDate = document.createElement("td");
                dueDate.textContent = taskdata[i]["dueDate"];

                status = document.createElement("td");
                status.textContent = "Finished";

                startDate = document.createElement("td");
                startDate.textContent = taskdata[i]["startDate"];

                endDate = document.createElement("td");
                endDate.textContent = taskdata[i]["endDate"];

                time = document.createElement("td");
                time.textContent = taskdata[i]["Task_Time"] + " seconds";

                document.getElementsByTagName("tr").item(15).insertBefore(name, document.getElementsByTagName("tr").item(15).childNodes[2]);
                document.getElementsByTagName("tr").item(16).insertBefore(status, document.getElementsByTagName("tr").item(16).childNodes[2]);
                document.getElementsByTagName("tr").item(17).insertBefore(desc, document.getElementsByTagName("tr").item(17).childNodes[2]);
                document.getElementsByTagName("tr").item(18).insertBefore(dueDate, document.getElementsByTagName("tr").item(18).childNodes[2]);
                document.getElementsByTagName("tr").item(19).insertBefore(startDate, document.getElementsByTagName("tr").item(19).childNodes[2]);
                document.getElementsByTagName("tr").item(20).insertBefore(endDate, document.getElementsByTagName("tr").item(20).childNodes[2]);
                document.getElementsByTagName("tr").item(21).insertBefore(time, document.getElementsByTagName("tr").item(21).childNodes[2]);
            }
            break
        }
    }
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
            if (!(typeof n == "undefined")) {
                n.textContent = null;
                d.textContent = null;
                dDate.textContent = null;
                st.textContent = null;
                sd.textContent = null;
                ed.textContent = null;
                t.textContent = null;

                div_show_pending();

                n.textContent = taskdata[i]["Name"];
                if (taskdata[i]["Description"] == "null") {
                    d.textContent = "";
                }
                else {
                    d.textContent = taskdata[i]["Description"];
                }

                dDate.textContent = taskdata[i]["dueDate"];
                st.textContent = "Pending";
                sd.textContent = taskdata[i]["startDate"];
                ed.textContent = "N/A";
                t.textContent = taskdata[i]["Task_Time"] +  " seconds";
            }
            else {
                div_show_pending();

                name = document.createElement("td");
                name.textContent = taskdata[i]["Name"];

                desc = document.createElement("td");
                if (taskdata[i]["Description"] != "null") {
                    desc.textContent = taskdata[i]["Description"];
                } else {
                    desc.textContent = "";
                }

                dueDate = document.createElement("td");
                dueDate.textContent = taskdata[i]["dueDate"];

                status = document.createElement("td");
                status.textContent = "Pending";

                startDate = document.createElement("td");
                startDate.textContent = taskdata[i]["startDate"];

                endDate = document.createElement("td");
                endDate.textContent = "N/A";

                time = document.createElement("td");
                time.textContent = taskdata[i]["Task_Time"] + " seconds";

                document.getElementsByTagName("tr").item(7).insertBefore(name, document.getElementsByTagName("tr").item(7).childNodes[2]);
                document.getElementsByTagName("tr").item(8).insertBefore(status, document.getElementsByTagName("tr").item(8).childNodes[2]);
                document.getElementsByTagName("tr").item(9).insertBefore(desc, document.getElementsByTagName("tr").item(9).childNodes[2]);
                document.getElementsByTagName("tr").item(10).insertBefore(dueDate, document.getElementsByTagName("tr").item(10).childNodes[2]);
                document.getElementsByTagName("tr").item(11).insertBefore(startDate, document.getElementsByTagName("tr").item(11).childNodes[2]);
                document.getElementsByTagName("tr").item(12).insertBefore(endDate, document.getElementsByTagName("tr").item(12).childNodes[2]);
                document.getElementsByTagName("tr").item(13).insertBefore(time, document.getElementsByTagName("tr").item(13).childNodes[2]);
            }
            break
        }
    }
}

function div_hide_start() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_start").style.display= "none";
}

function div_show_start() {
    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_start").style.display = "block";
}

function div_show_pending() {
    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_pending").style.display = "block";
}

function div_hide_pending() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_pending").style.display= "none";
}

function div_hide_finished() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_finish").style.display= "none";
}

function div_show_finished() {
    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_finish").style.display = "block";
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