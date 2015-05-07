function deleteBoard(name) {
    $.ajax({
        type: "POST",
        url: "/include/delete.php",
        data: {name: name, type: 'board'},
        success: function() {
            console.log("Kustutasin boardi ära.");
            document.getElementById("form_popup").style.display = "none";
            document.getElementById("popup_desc").style.display = "none";
        }
    })
}

function deleteTask(id) {
    $.ajax({
        type: "POST",
        url: "/include/delete.php",
        data: {name: id, type: 'task'},
        success: function() {
            console.log("Kustutasin taski ära.");
            document.getElementById("form_popup").style.display = "none";
            document.getElementById("popup_start").style.display = "none";
            document.getElementById("popup_pending").style.display = "none";
            document.getElementById("popup_finish").style.display = "none";
        }
    })
}