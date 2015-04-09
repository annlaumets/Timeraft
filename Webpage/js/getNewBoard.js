/**
 * Created by Viktoria on 3.04.2015.
 */

function fetchNewBoard(lastID) {
    var t;

    $.ajax({
        url: '/include/polling.php',
        type: 'GET',
        async: true,
        data: {'lastID': lastID},
        dataType: 'json',
        success: function (data) {
            clearInterval(t);
            console.log(data.status);
            if (data.status == 'results' || data.status == 'no-new-boards') {
                if (data.status == 'results') {
                    loadBoard();
                }
                t = setTimeout(fetchNewBoard(data.lastID), 30000);
            }
        }
    });
}

$(window).load(function () {
    var id = boarddata[boarddata.length - 1];
    fetchNewBoard(id);
});
