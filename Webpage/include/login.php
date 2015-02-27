<?php

session_start();

require_once("db_connection.php");

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $pass = $_POST["password"];

// To avoid MySQL injection
    $name = mysql_real_escape_string(stripcslashes($name));
    $pass = mysql_real_escape_string(stripcslashes($pass));

// Check whether input is valid
    if (!$name || !$pass) {
        die("You did not fill in all of required fields.");
    }

    $query = mysql_query("SELECT * FROM Users WHERE Name = '$name' AND Password = '$pass'");
    $result = mysql_num_rows($query);

    if ($result) {
        if ($result > 0) {
            echo "Succeeded.";
            header("location: /mainboard.html");
        } else {
            echo "Failed.";
        }
    } else {
        die("Query failed.");
    }
}
