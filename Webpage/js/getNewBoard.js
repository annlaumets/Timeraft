/**
 * Created by Viktoria on 3.04.2015.
 */

function fetchNewBoard(timestamp, lastID) {

    if (typeof lastID == 'undefined') {
        lastID = 0;
    }

    $.ajax({
        url: '/include/polling.php',
        type: 'GET',
        async: true,
        cache: false,
        timeout: 30000,
        data: {'timestamp': timestamp, 'lastID': lastID},
        dataType: 'json',
        success: function (data) {
            console.log(data.status);
            console.log(data.data);
            if (data.status == 'results') {
                loadBoard();
            }
            setTimeout(fetchNewBoard(data.timestamp, data.lastID), 10000);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            setTimeout(fetchNewBoard(time), 10000);
        }
    });
}
var time = Date.now() / 1000;
$(function () {
    fetchNewBoard(time);
});