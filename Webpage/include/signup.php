<?php

session_start();

require_once("db_connection.php");

if (isset($_POST["submit_x"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    // To avoid MySQL injection
    $name = mysql_real_escape_string(stripcslashes($name));
    $email = mysql_real_escape_string(stripcslashes($email));
    $pass = mysql_real_escape_string(stripcslashes($pass));

    // Check if e-mail already in use
    $check = mysql_query("SELECT * FROM Users WHERE Email = '$email'");
    $check_result = mysql_num_rows($check);

    if ($check_result != 0) {
        die("Sorry, you already have an account.");
    }

    $insert = mysql_query("CALL add_user('$name', '$pass', '$email')");

    if ($insert) {
        header("location: /mainboard.php");
    }
}