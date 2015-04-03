var taskdata = []; //siia salvestama taskide data, et popupi ajal kasutada
var taskID;
var boardName;
$(window).load(function () {
    $.ajax({
        type: "GET",
        url: "/include/showtasks.php",
        dataType: "json",
        data: {'boardURL': window.location.href},
        success: function (data) {
            if (data.length != 0) {
                taskdata.push.apply(taskdata, data);
                for (var i = 0; i < data.length; i++) {
                    var p = document.createElement("p");
                    p.textContent = JSON.stringify(taskdata[i]["Name"]);

                    var id = data[i]["ID"];
                    var boardname = data[i]["boardName"];

                    if (taskdata[i]["Task_Type"] == "ToDo") {
                        document.body.getElementsByClassName("boardpcontainer").item(0).appendChild(p);
                        p.addEventListener("click", showToDo.bind(null, p.textContent, id, boardname));
                    }
                    else if (taskdata[i]["Task_Type"] == "Pending") {
                        document.body.getElementsByClassName("boardpcontainer").item(1).appendChild(p);
                        p.addEventListener("click", showPending.bind(null, p.textContent, id, boardname));
                    }
                    else if (taskdata[i]["Task_Type"] == "Finished") {
                        document.body.getElementsByClassName("boardpcontainer").item(2).appendChild(p);
                        p.addEventListener("click", showFinish.bind(null, p.textContent, id, boardname));
                    }
                }
            }

            function showToDo (task, id, board) {
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
                    if (taskdata[i]["Name"] == task.replace(/[""]/g,'')) {
                        taskID = id.replace(/[""]/g, '');
                        boardName = board.replace(/[""]/g, '');
                        if (typeof n == "undefined") {

                            name = document.createElement("td");
                            name.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g, '');

                            desc = document.createElement("td");if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                                desc.textContent = "";
                            }
                            else {
                                desc.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                            }
                            dueDate = document.createElement("td");
                            dueDate.textContent = JSON.stringify(taskdata[i]["dueDate"]).replace(/[""]/g, '');

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
                        else {
                            n.textContent = null;
                            d.textContent = null;
                            dDate.textContent = null;
                            st.textContent = null;
                            sd.textContent = null;
                            ed.textContent = null;

                            n.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g,'');if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                                d.textContent = "";
                            }
                            else {
                                d.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                            }
                            dDate.textContent = JSON.stringify(taskdata[i]["dueDate"]).replace(/[""]/g, '');
                            st.textContent = "Not started";
                            sd.textContent = "N/A";
                            ed.textContent = "N/A";

                        }
                    }
                }
                document.getElementById("form_popup").style.display = "block";
                document.getElementById("popup_start").style.display = "block";

            }

            function showPending (task, id, board) {
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
                    if (taskdata[i]["Name"] == task.replace(/[""]/g,'')) {
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
                            dueDate.textContent = JSON.stringify(taskdata[i]["dueDate"]).replace(/[""]/g, '');

                            status = document.createElement("td");
                            status.textContent = "Pending";

                            startDate = document.createElement("td");
                            startDate.textContent = JSON.stringify(taskdata[i]["startDate"]).replace(/[""]/g, '');

                            endDate = document.createElement("td");
                            endDate.textContent = "N/A";

                            time = document.createElement("td");
                            time.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g, '');

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

                            n.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g,'');
                            if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                                d.textContent = "";
                            }
                            else {
                                d.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                            }
                            dDate.textContent = JSON.stringify(taskdata[i]["dueDate"]).replace(/[""]/g, '');
                            st.textContent = "Pending";
                            sd.textContent = JSON.stringify(taskdata[i]["startDate"]).replace(/[""]/g,'');
                            ed.textContent = "N/A";
                            t.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g,'');
                        }
                    }
                }

                document.getElementById("form_popup").style.display = "block";
                document.getElementById("popup_pending").style.display = "block";
            }

            function showFinish (task, id, board) {
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
                    if (taskdata[i]["Name"] == task.replace(/[""]/g,'')) {
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
                            dueDate.textContent = JSON.stringify(taskdata[i]["dueDate"]).replace(/[""]/g, '');

                            status = document.createElement("td");
                            status.textContent = "Finished";

                            startDate = document.createElement("td");
                            startDate.textContent = JSON.stringify(taskdata[i]["startDate"]).replace(/[""]/g, '');

                            endDate = document.createElement("td");
                            endDate.textContent = JSON.stringify(taskdata[i]["endDate"]).replace(/[""]/g, '');

                            time = document.createElement("td");
                            time.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g, '');

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

                            n.textContent = JSON.stringify(taskdata[i]["Name"]).replace(/[""]/g,'');
                            if (JSON.stringify(taskdata[i]["Description"]) == "null") {
                                d.textContent = "";
                            }
                            else {
                                d.textContent = JSON.stringify(taskdata[i]["Description"]).replace(/[""]/g, '');
                            }
                            dDate.textContent = JSON.stringify(taskdata[i]["dueDate"]).replace(/[""]/g, '');
                            st.textContent = "Finished";
                            sd.textContent = JSON.stringify(taskdata[i]["startDate"]).replace(/[""]/g,'');
                            ed.textContent = JSON.stringify(taskdata[i]["endDate"]).replace(/[""]/g,'');
                            t.textContent = JSON.stringify(taskdata[i]["Task_Time"]).replace(/[""]/g,'');
                        }
                    }
                }

                document.getElementById("form_popup").style.display = "block";
                document.getElementById("popup_finish").style.display = "block";
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

function taskURL() {
    return taskID;
}

function boardURL () {
    return boardName;
}