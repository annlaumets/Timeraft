<?php

session_start();

require_once("db_connection.php");

if (isset($_SESSION['login'])) {
    header("location: /mainboard.php");
    exit();
}

if (isset($_POST["submit_x"])) {

    $email = $_POST["email"];
    $pass = $_POST["password"];

// To avoid MySQL injection
    $email = mysql_real_escape_string(stripcslashes($email));
    $pass = mysql_real_escape_string(stripcslashes($pass));

    $query = mysql_query("SELECT * FROM Users WHERE Email = '$email' AND Password = '$pass'");
    $result = mysql_num_rows($query);

    if ($result) {
        if ($result > 0) {
            session_regenerate_id(true);
            $_SESSION['login'] = true;
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