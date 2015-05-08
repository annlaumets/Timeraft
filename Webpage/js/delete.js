function deleteBoard(name) {
    $.ajax({
        type: "POST",
        url: "/include/delete.php",
        data: {name: name, type: 'board'},
        success: function() {
            document.getElementById("form_popup").style.display = "none";
            document.getElementById("popup_desc").style.display = "none";
            for (var i = 0; i < boarddata.length; i++) {
                if (boarddata[i].Name == name) {
                    var len = boarddata.length;
                    boarddata.splice(i, 1);

                    if (i < len/2) {
                        var container = document.body.getElementsByClassName("maincontainer").item(0);
                        for (var a = 0; a < container.childNodes.length; a++) {
                            if (container.childNodes[a].textContent == name) {
                                container.removeChild(container.childNodes[a]);
                            }
                        }
                    }
                    else {
                        var container2 = document.body.getElementsByClassName("maincontainer").item(1);
                        for (var b = 0; b < container2.childNodes.length; b++) {
                            if (container2.childNodes[b].textContent == name) {
                                container2.removeChild(container2.childNodes[b]);
                            }
                        }
                    }
                }
            }
        }
    })
}

function deleteTask(id) {
    $.ajax({
        type: "POST",
        url: "/include/delete.php",
        data: {name: id, type: 'task'},
        success: function() {
            document.getElementById("form_popup").style.display = "none";
            document.getElementById("popup_start").style.display = "none";
            document.getElementById("popup_pending").style.display = "none";
            document.getElementById("popup_finish").style.display = "none";

            for (var i = 0; i < taskdata.length; i++) {
                if (taskdata[i].ID == id) {
                    var type = taskdata[i].Task_Type;
                    var name = JSON.stringify(taskdata[i].Name);
                    taskdata.splice(i, 1);

                    if (type == "ToDo") {
                        var container1 = document.body.getElementsByClassName("boardpcontainer").item(0);
                        for (var j = 0; j < container1.childNodes.length; j++) {
                            if (container1.childNodes[j].textContent == name) {
                                container1.removeChild( container1.childNodes[j]);
                            }
                        }
                    }
                    else if (type == "Pending") {
                        var container2 = document.body.getElementsByClassName("boardpcontainer").item(1);
                        for (var k = 0; k < container2.childNodes.length; k++) {
                            if (container2.childNodes[k].textContent == name) {
                                container2.removeChild(container2.childNodes[k]);
                            }
                        }

                    }
                    else if (type == "Finished") {
                        var container3 = document.body.getElementsByClassName("boardpcontainer").item(2);
                        for (var l = 0; l < container3.childNodes.length; l++) {
                            if (container3.childNodes[l].textContent == name) {
                                container3.removeChild(container3.childNodes[l]);
                            }
                        }
                    }
                }
            }
        }
    })
}