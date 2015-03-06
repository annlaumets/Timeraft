/**
 * Created by Ann on 20.02.2015.
 */

function div_show_signin() {
    document.getElementById("form_signin").style.display= "block";
    document.getElementById("popup_signin").style.display = "block";
}

function div_show_signup() {

    document.getElementById("form_signup").style.display= "block";
    document.getElementById("popup_signup").style.display = "block";
}

function div_hide_signin() {
    document.getElementById("form_signin").style.display = "none";
    document.getElementById("popup_signin").style.display = "none";
}

function div_hide_signup() {
    document.getElementById("form_signup").style.display = "none";
    document.getElementById("popup_signup").style.display = "none";
}

//If page loads, it displays the right username
$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/include/username.php",
        success: function (msg) {
            document.getElementById("account").innerHTML = msg;
        }
    });
});

//Checks in Safari if all fields in signin are correct
var forms = document.getElementById("form2_signin").getElementsByTagName("input");
for (var i = 0; i < forms.length; i++) {
    forms[i].noValidate = true;

    forms[i].addEventListener('submit', function(event) {
        //Prevent submission if checkValidity on the form returns false.
        if (!event.target.checkValidity()) {
            event.preventDefault();
            alert("Error.")
            //Implement you own means of displaying error messages to the user here.
        }
    }, false);
}

