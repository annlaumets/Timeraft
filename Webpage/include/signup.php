<?php
session_start();
require("db_connection.php");

function cryptpw($password) {
    // Change these options for more security, right now generating new salt automatically
    $options = [
        // 'salt' => custom_function_for_salt(), //write your own code to generate a suitable salt
        'cost' => 11 // the default cost is 10
    ];
    return $hash = password_hash($password, PASSWORD_DEFAULT, $options);
}

if (isset($_POST["submit_x"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $signupStmt = $conn->prepare("SELECT ID FROM Users WHERE Email = :email");
    $signupStmt->execute(array('email'=>$email));

    $checkRes = $signupStmt->fetchAll();

    if (count($checkRes) != 0) {
        // Probably will want better error handling here !
        die("Sorry, Account with this email has already been registered");
    }
    // Kutsub add_user meetodi, bindparam annab 3 parameetrit - name, pass, email
    $insert = $conn->prepare("CALL sp_add_user(:name, :pass, :email)");
    $cpass = cryptpw($pass);
    $insert->execute(array('name' => $name, 'pass' => $cpass, 'email' => $email));

    $idstmt = $conn->prepare("SELECT ID FROM Users WHERE Email = :email");
    $idstmt->execute(array('email' => $email));
    $id = $idstmt->fetch(PDO::FETCH_ASSOC);

    if ($insert) {
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['loginUser'] = $email;
        $_SESSION['UserID'] = $id['ID'];
        header("location: /mainboard.php");
    } else {
        // Better error handling here ?
        die("Signup error, Andre viga");
    }
} else {
    die("Signup error, Andre viga");
}