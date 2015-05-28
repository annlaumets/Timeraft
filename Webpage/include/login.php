<?php

session_start();

require("db_connection.php");

if ($_SESSION['login'] == true) {
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
    $loginStmt = $conn->prepare("SELECT ID, Password FROM Users WHERE Email = :email");
    $loginStmt->execute(array('email' => $email));
    $result = $loginStmt->fetch(PDO::FETCH_ASSOC);
    $userID = $result['ID'];

    if ($result) {
        if (password_verify($pass, $result['Password'])) {
            /*
            if (password_needs_rehash($result['Password'], PASSWORD_DEFAULT, ['cost' => 11])) {
                $cpass = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 11]);
                $rehashSttmt = $conn -> prepare("CALL sp_reHash_change_passw(:cpass, :id);");
                $rehashSttmt -> execute(array('cpass' => $cpass, 'id' => $result['ID']));
                file_put_contents("rehashing.txt", "Just did a rehash to: ".$email, FILE_APPEND);
            }
            Don't need this right now.
            */
            session_regenerate_id(true);
            $_SESSION['login'] = true;
            $_SESSION['loginUser'] = $email;
            $_SESSION['UserID'] = $userID;

            $updateLastVisited = $conn->prepare("CALL sp_lastVisit('$userID')");
            $updateLastVisited->execute();

            if ($redirectURL) {
                header("Location:" . $redirectURL);
            } else {
                header("Location: /mainboard.php");
            }
            exit;
        } else {
            die("Password verification failed");
        }
    } else {
        die("Query failed.");
    }
} else {
    die("Login failed");
}