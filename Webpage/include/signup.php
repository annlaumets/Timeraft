<?php

session_start();

require("db_connection.php");

if (isset($_POST["submit_x"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $signupStmt = $conn->prepare("SELECT * FROM Users WHERE Email = :email");
    $signupStmt->execute(array('email'=>$email));

    $checkRes = $signupStmt->fetchAll();

    if (count($checkRes) != 0) {
        // Probably will want better error handling here !
        die("Sorry, Account with this email has already been registered");
    }
    // Kutsub add_user meetodi, bindparam annab 3 parameetrit - name, pass, email
    $insert = $conn->prepare("CALL add_user('$name', '$pass', '$email')");
    $insert->execute();
    if ($insert) {
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['loginUser'] = $email;
        header("location: /mainboard.php");
    } else {
        // Better error handling here ?
        die("Signup error, Andre viga");
    }
}