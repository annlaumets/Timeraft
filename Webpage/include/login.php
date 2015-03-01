<?php

session_start();

require_once("db_connection.php");

if (isset($_SESSION['login_user'])) {
    header("location: /mainboard.php");
}

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $pass = $_POST["password"];

// To avoid MySQL injection
    $email = mysql_real_escape_string(stripcslashes($email));
    $pass = mysql_real_escape_string(stripcslashes($pass));

// Check whether input is valid
    if (empty($email) || empty($pass)) {
        die("You did not fill in all of required fields.");
    }

    $query = mysql_query("SELECT * FROM Users WHERE Email = '$email' AND Password = '$pass'");
    $result = mysql_num_rows($query);

    if ($result) {
        if ($result > 0) {
            $_SESSION['login_user'] = $email;
            $update_visit_time = mysql_query("UPDATE Users SET Time_Last_Visited = now() WHERE Email = '$email'");
            header("location: /mainboard.php");
        } else {
            echo "Failed.";
        }
    } else {
        die("Query failed.");
    }
}