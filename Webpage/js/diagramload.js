$(window).load(function () {
    setInterval(checkHash, 10);
    var valimine = document.getElementById("boardSelect");
    valimine.addEventListener('change', function() {
        var id = valimine.options[valimine.selectedIndex].value;
        history.pushState(id, "Test", "/stats?board=" + id);
        canvas = document.getElementById("boardDiagram");
    });
    var all = document.createElement("option");
    all.textContent = "All boards";
    all.value = 0;
    valimine.insertBefore(all, valimine.lastChild);
    $.ajax({
        type: "GET",
        url: "/include/showboards.php",
        dataType: 'json',
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                var opt = document.createElement("option");
                opt.textContent = JSON.stringify(data[i]["Name"]).replace(/[""]/g, '');
                opt.value = JSON.stringify(data[i]["ID"]).replace(/[""]/g, '');
                valimine.insertBefore(opt, valimine.lastChild);
            }
        },
        error: function() {
            console.log("Diagramload.js boardide lugemine andmebaasist error ÜKS.");
            for (var i = 0; i < sessionStorage.getItem("Boards").length; i++) {
                var opt = document.createElement("option");
                opt.textContent = JSON.stringify(data[i]["Name"]).replace(/[""]/g, '');
                opt.value = JSON.stringify(data[i]["ID"]).replace(/[""]/g, '');
                valimine.insertBefore(opt, valimine.lastChild);
            }
            console.log("Diagramload.js boardide lugemine andmebaasist error KAKS.");
        }
    });
});

var recentHash = "";
function checkHash() {
    //var hash = document.location.hash;
    var hashSuur = window.location.search.substring(1);
    var hashArray = hashSuur.split('=');
    if (hashArray[1]) {
        if (hashArray[1] == recentHash) {
            return;
        }
        recentHash = hashArray[1];
        history.pushState(hashArray[1], "Test", "/stats?board=" + hashArray[1]);
        loadPage(hashArray[1]);
    }
}

function loadPage(id) {
    $.ajax({
        type: "GET",
        url: "/include/boardStats.php",
        data: {"boardID":id},
        success: function(data) {
            var valimine = document.getElementById("boardSelect");
            valimine.selectedIndex = id;

            var data2 = JSON.parse(data);
            sessionStorage.setItem("Stats?id=" + id, data2);

            canvas = document.getElementById("diagramCanvas");
            ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            var sum = 0;
            for (var i = 0; i < data2.length; i++) {
                sum += parseInt(data2[i].Task_Time);
            }

            var uus = 0;
            for (var j = 0; j < data2.length; j++) {
                uus = (parseInt(data2[j].Task_Time)/sum)*360;
                data2[j].Task_Time = uus;
                drawSegment(data2, canvas, ctx, j);
            }

        },
        error: function() {
            console.log("loadPage'i error.");
        }
    })
}

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function drawSegment(data, canvas, context, i) {
    context.save();
    var centerX = Math.floor(canvas.width / 2);
    var centerY = Math.floor(canvas.height / 2);
    radius = Math.floor(canvas.width / 2);

    var startingAngle = degreesToRadians(sumTo(data, i));
    var arcSize = degreesToRadians(data[i].Task_Time);
    var endingAngle = startingAngle + arcSize;

    context.beginPath();
    context.moveTo(centerX, centerY);
    context.arc(centerX, centerY, radius,
        startingAngle, endingAngle, false);
    context.closePath();

    context.fillStyle = getRandomColor();
    context.fill();

    context.restore();

    drawSegmentLabel(data, canvas, context, i);
}

function degreesToRadians(degrees) {
    return (degrees * Math.PI)/180;
}

function sumTo(a, i) {
    var sum = 0;
    for (var j = 0; j < i; j++) {
        sum += a[j].Task_Time;
    }
    return sum;
}

function drawSegmentLabel(data, canvas, context, i) {
    context.save();
    var x = Math.floor(canvas.width / 2);
    var y = Math.floor(canvas.height / 2);
    var angle = degreesToRadians(sumTo(data, i));

    context.translate(x, y);
    context.rotate(angle);
    var dx = Math.floor(canvas.width * 0.5) - 10;
    var dy = Math.floor(canvas.height * 0.03);

    context.textAlign = "right";
    var fontSize = Math.floor(canvas.height / 50);
    context.font = fontSize + "pt Helvetica";

    context.fillText(data[i].Name, dx, dy);

    context.restore();
}