<?php

session_start();
require("db_connection.php");
include "login.php";

function updateUserInfo($conn, $userID, $newName, $newPassword, $newBio) {
    $delete = $conn->prepare("CALL sp_updateUserInfo(:userId, :newName, :newPw, :newBio)");
    $delete->execute(array('userId' => $userID, 'newName' => $newName, 'newPw' => $newPassword, 'newBio' => $newBio));
}

if (isset($_POST)) {
    $loginStmt = $conn->prepare("SELECT Password FROM Users WHERE ID = :uid");
    $loginStmt->execute(array('uid' => $_SESSION['UserID']));
    $result = $loginStmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST['oldPassword'], $result['Password'])){
        if ($_POST['newPassword1']=="") {
            $cpass = $result['Password'];
        } else {
            if ($_POST['newPassword1']===$_POST['newPassword2']){
                $cpass = cryptpw($_POST['newPassword1']);
            } else {
                die("newPassword1 and newPassword2 are not equal.");
            }
        }
        $user_ID = $_SESSION['UserID'];
        updateUserInfo($conn, $user_ID, $_POST['userId'], $_POST['newName'], $cpass, $_POST['newBio']);
    } else {
        die("Old password was wrong");
    }
} else {
    die("Need error handling here - updateUserInfo.php");
}
