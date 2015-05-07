function deleteBoard(name) {
    $.ajax({
        type: "POST",
        url: "/include/delete.php",
        data: {name: name, type: 'board'},
        success: function() {
            console.log("Kustutasin boardi " +
            "ära.")
        }
    })
}

function deleteTask(id) {
    $.ajax({
        type: "POST",
        url: "/include/delete.php",
        data: {name: id, type: 'task'},
        success: function() {
            console.log("Kustutasin taski ära.")
        }
    })
}