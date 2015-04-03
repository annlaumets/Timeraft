/**
 * Created by Viktoria on 3.04.2015.
 */

function fetchNewBoard(timestamp, lastID) {
    var t;

    if (typeof lastID == 'undefined') {
        lastID = 0;
    }

    $.ajax({
        url: '/include/polling.php',
        type: 'GET',
        async: true,
        data: {'timestamp': timestamp, 'lastID': lastID},
        dataType: 'json',
        success: function (data) {
            clearInterval(t);
            console.log(data.status);
            if (data.status == 'results' || data.status == 'no-new-boards') {
                if (data.status == 'results') {
                    loadBoard();
                }
                t = setTimeout(fetchNewBoard(data.timestamp, data.lastID), 1000);
            }
        }
    });
}
var time = Date.now() / 1000;
$(function () {
    fetchNewBoard(time);
});