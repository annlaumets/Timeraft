<?php

session_start();

require("db_connection.php");

if (isset($_SESSION['login'])) {
    header("location: /mainboard.php");
    exit;
}

if (isset($_POST["submit_x"])) {

    $redirectURL = NULL;
    if (!empty($_POST['redirect'])) {
        $redirectURL = $_POST['redirect'];
    }

    $email = $_POST["email"];
    $pass = $_POST["password"];

    //UUs PDO kood
    $loginStmt = $conn->prepare("SELECT * FROM Users WHERE Email = :email AND Password = :pass");
    $loginStmt->execute(array('email'=>$email, 'pass'=>$pass));
    $result = $loginStmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (count($result) > 0) {
            session_regenerate_id(true);
            $_SESSION['login'] = true;
            $_SESSION['loginUser'] = $email;
            $updateLastVisited = $conn->prepare("Update Users SET Time_Last_Visited = now() WHERE Email = ".$email);
            if ($redirectURL) {
                // file_put_contents('error.txt', $redirectURL, FILE_APPEND | LOCK_EX);
                header("Location:" . $redirectURL);
            } else {
                header("Location: /mainboard.php");
            }
            exit;
        } else {
            echo "Failed.";
        }
    } else {
        die("Query failed.");
    }
}