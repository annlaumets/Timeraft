var boarddata = []; //siia salvestama boardide data, et popupi ajal kasutada

$(window).load(function () {
    $.ajax({
        type: "GET",
        url: "/include/showboards.php",
        dataType: "json",
        success: function (data) {
            if (data.length != 0) {
                boarddata.push(data);

                for (var i = 0; i < data.length; i++) {
                    var list = document.createElement("div");
                    var boardpcontainer = document.createElement("div");
                    var p = document.createElement("p");

                    list.className = "list";
                    boardpcontainer.className = "boardpcontainer";

                    if (i < data.length / 2) {
                        document.body.getElementsByClassName("maincontainer").item(0).appendChild(list);
                        document.body.getElementsByClassName("list").item(i).appendChild(boardpcontainer);
                        document.body.getElementsByClassName("boardpcontainer").item(i).appendChild(p);
                    } else {
                        document.body.getElementsByClassName("maincontainer").item(1).appendChild(list);
                        document.body.getElementsByClassName("list").item(i).appendChild(boardpcontainer);
                        document.body.getElementsByClassName("boardpcontainer").item(i).appendChild(p);
                    }

                    p.textContent = JSON.stringify(boarddata[0][i]["Name"]);
                    
                    function showBoardInfo(board) {
                        var name;
                        var desc;
                        var n = document.getElementsByTagName("h3").item(0).childNodes[1];
                        var d = document.getElementsByTagName("h3").item(1).childNodes[1];

                        if (!(typeof n == "undefined")) {
                            n.textContent = null;
                            d.textContent = null;
                            div_show();

                            for (var i = 0; i < data.length; i++) {
                                if (boarddata[0][i]["Name"] == board.split('"').join("")) {
                                    console.log("Data[i]: " + JSON.stringify(boarddata[0][i]));
                                    console.log("Data[i] desc: " + JSON.stringify(boarddata[0][i]["Description"]));

                                    n.textContent = JSON.stringify(boarddata[0][i]["Name"]);
                                    d.textContent = JSON.stringify(boarddata[0][i]["Description"]);
                                }
                            }
                        } else {
                            div_show();

                            for (var i = 0; i < data.length; i++) {
                                if (boarddata[0][i]["Name"] == board.split('"').join("")) {
                                    console.log("Data[i]: " + JSON.stringify(boarddata[0][i]));
                                    console.log("Data[i] desc: " + JSON.stringify(boarddata[0][i]["Description"]));

                                    name = document.createElement("p");
                                    name.textContent = JSON.stringify(boarddata[0][i]["Name"]);
                                    document.getElementsByTagName("h3").item(0).appendChild(name);

                                    desc = document.createElement("p");
                                    desc.textContent = JSON.stringify(boarddata[0][i]["Description"]);
                                    document.getElementsByTagName("h3").item(1).appendChild(desc);
                                }
                            }
                        }
                    }
                    p.addEventListener("click", showBoardInfo.bind(null, p.textContent));
                }

                //lisamise nupp
                var list3 = document.createElement("div");
                var boardpcontainer3 = document.createElement("div");
                var p3 = document.createElement("p");

                list3.className = "list";
                boardpcontainer3.className = "boardpcontainer";

                p3.textContent = "+"; //kui veel ühtegi boardi pole tehtud
                p3.addEventListener("click", function () {
                    document.getElementById("form_popup").style.display = "block";
                    document.getElementById("popup_newdesc").style.display = "block";
                });

                document.body.getElementsByClassName("maincontainer").item(1).appendChild(list3);
                var pikkusList = document.body.getElementsByClassName("list").length;

                document.body.getElementsByClassName("list").item(pikkusList - 1).appendChild(boardpcontainer3);
                var pikkusBoard = document.body.getElementsByClassName("boardpcontainer").length;

                document.body.getElementsByClassName("boardpcontainer").item(pikkusBoard - 1).appendChild(p3);
            } else {
                var p2 = document.createElement("p");
                var list2 = document.createElement("div");
                var boardpcontainer2 = document.createElement("div");

                list2.className = "list";
                boardpcontainer2.className = "boardpcontainer";

                p2.textContent = "+"; //kui veel ühtegi boardi pole tehtud
                p2.addEventListener("click", function () {
                    document.getElementById("form_signin").style.display = "block";
                    document.getElementById("popup_newdesc").style.display = "block";
                });

                document.body.getElementsByClassName("maincontainer").item(0).appendChild(list2);
                document.body.getElementsByClassName("list").item(0).appendChild(boardpcontainer2);
                document.body.getElementsByClassName("boardpcontainer").item(0).appendChild(p2);
            }
        }
    });
});

function div_show() {
    document.getElementById("form_popup").style.display = "block";
    document.getElementById("popup_desc").style.display = "block";
}

function div_hide() {
    document.getElementsByTagName("h3").item(0).childNodes[1].textContent = null;
    document.getElementsByTagName("h3").item(1).childNodes[1].textContent = null;
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_desc").style.display = "none";
}

function div_hide_new() {
    document.getElementById("form_popup").style.display = "none";
    document.getElementById("popup_newdesc").style.display = "none";
}