$(window).load(function() {

    timer(); //kutsub kohe timeri välja, et aeg jooksma hakkaks

    var h1 = document.getElementsByTagName('h1')[0],
        seconds = 0, minutes = 0, hours = 0,
        t;

   function add() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
        }

        h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
        timer();
    }

    function timer() {
        t = setTimeout(add, 1000);
    }

    document.getElementById('pause2').addEventListener('click', function () {
        if (typeof window.sessionStorage != "undefined") {
            var urlArray = window.location.href.split('?');
            sessionStorage.setItem("pauseTime?" + urlArray[1], t);
        }
        clearTimeout(t);
        $.ajax({
            type: "GET",
            url: "include/addTime.php",
            data: {'taskURL': window.location.href, 'taskTime': t, 'type': 'pause'},
            success: function(data) {
                console.log(data);
                window.location.href = '/board.php?tasks=' + data;
            },
            error: function() {
                var urlArray = window.location.href.split('?');
                var url = urlArray[1].split('&');
                console.log("Pausi error.");
                console.log("Time: " + sessionStorage.getItem("pauseTime?" + urlArray[1]));
                window.location.href = '/board.php?' + url[0];
            }
        })
    });

    document.getElementById('stop2').addEventListener('click', function () {
        if (typeof window.sessionStorage != "undefined") {
            var urlArray = window.location.href.split('?');
            sessionStorage.setItem("stopTime?" + urlArray[1], t);
        }
        clearTimeout(t);
        $.ajax({
            type: "GET",
            url: "include/addTime.php",
            data: {'taskURL': window.location.href, 'taskTime': t, 'type': 'stop'},
            success: function(data) {
                window.location.href = '/board.php?tasks=' + data;
            },
            error: function() {
                var urlArray = window.location.href.split('?');
                var url = urlArray[1].split('&');
                console.log("Stopi error.");
                console.log("Time: " + sessionStorage.getItem("stopTime?" + urlArray[1]));
                window.location.href = '/board.php?' + url[0];
            }
        })
    });

});