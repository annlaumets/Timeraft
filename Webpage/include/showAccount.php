<?php

session_start();
require("db_connection.php");

if (isset($_SESSION['UserID'])){
    $userId = $_SESSION['UserID'];
    $loginStmt = $conn->prepare("CALL sp_getBio(:userID)");
    $loginStmt->execute(array('userID' => $userId));
    $result = $loginStmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
}