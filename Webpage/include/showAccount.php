<?php

session_start();
require("db_connection.php");

if (isset($_SESSION['UserID'])){
    if(isset($_GET['settings'])) {
        $userId = $_SESSION['UserID'];
        $loginStmt = $conn->prepare("SELECT Name, Bio FROM Users WHERE ID = :uid");
        $loginStmt->execute(array('uid' => $userId));
        $result = $loginStmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        $userId = $_SESSION['UserID'];
        $loginStmt = $conn->prepare("CALL sp_getBio(:userID)");
        $loginStmt->execute(array('userID' => $userId));
        $result = $loginStmt->fetch(PDO::FETCH_ASSOC);
        if ($result["Filepath"]!="") {
            $result["Filepath"] = str_split($result["Filepath"],30);
            $result["Filepath"] = $result["Filepath"][1];
        }
        file_put_contents("profile.txt", $result['Email'], FILE_APPEND);
        echo json_encode($result);
    }
}