<?php

session_start();
require("db_connection.php");

function updateUserInfo($conn, $userID, $newName, $newPassword, $newBio) {
    $delete = $conn->prepare("CALL sp_updateUserInfo(:userId, :newName, :newPw, :newBio)");
    $delete->execute(array('userId' => $userID, 'newName' => $newName, 'newPw' => $newPassword, 'newBio' => $newBio));
}

if (isset($_POST)) {
    $user_ID = $_SESSION['UserID'];
    updateUserInfo($conn, $user_ID, $_POST['userId'], $_POST['newName'], $_POST['newPassword'], $_POST['newBio']);
} else {
    die("Need error handling here - updateUserInfo.php");
}
