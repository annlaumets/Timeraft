/**
 * Created by Ann on 20.02.2015.
 */

function signUp() {
    document.getElementById("demo").innerHTML = "Sign up";
}

function signIn() {
    document.getElementById("demo").innerHTML = "Sign in";
}

function div_show() {
    document.getElementById("form").style.display= "block";
}

function div_hide() {
    document.getElementById("form").style.display = "none";
}

function check_empty() {
    if (document.getElementById('name').value == "" || document.getElementById('password').value == "") {
        alert("Fill All Fields !");
    } else {
        document.getElementById('form2').submit();
        alert("Form Submitted Successfully...");
    }
}