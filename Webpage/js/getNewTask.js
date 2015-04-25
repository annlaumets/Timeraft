/**
 * Created by ViktoriaP on 24.04.2015.
 */

function fetchNewTask(lastID) {
    var t;

    $.ajax({
        url: '/include/polling.php',
        type: 'GET',
        async: true,
        data: {'lastID_task': lastID, 'boardURL': window.location.href},
        dataType: 'json',
        success: function (data) {
            clearInterval(t);
            console.log(data.status);
            if (data.status == 'results' || data.status == 'no-new') {
                if (data.status == 'results') {
                    loadTask();
                }
                t = setTimeout(fetchNewTask(data.lastID), 30000);
            }
        }
    });
}

$(function () {
    var id = taskdata[taskdata.length - 1];
    fetchNewTask(id);
});
