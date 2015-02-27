/**
 * Created by Ann on 20.02.2015.
 */

function signUp() {
    document.getElementById("demo").innerHTML = "Sign up";
}

function signIn() {
    document.getElementById("demo").innerHTML = "Sign in";
}

function div_show_signin() {
    document.getElementById("form_signin").style.display= "block";
}

function div_show_signup() {
    document.getElementById("form_signup").style.display= "block";
}

function div_hide_signin() {
    document.getElementById("form_signin").style.display = "none";
}

function div_hide_signup() {
    document.getElementById("form_signup").style.display = "none";
}

function check_empty_signin() {
    if (document.getElementById('name_signin').value == "" || document.getElementById('password_signin').value == "") {
        alert("Fill All Fields!");
    } else {
        document.getElementById('form2_signin').submit();
        alert("Form Submitted Successfully...");
    }
}

function check_empty_signup() {
    if (document.getElementById('name_signup').value == "" || document.getElementById('password_signup').value == "" ||
        document.getElementById('email_signup').value == "") {
        alert("Fill All Fields!");
    } else {
        document.getElementById('form2_signup').submit();
        alert("Form Submitted Successfully...");
    }
}
