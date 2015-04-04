<?php
/**
 * Created by Andre
 */

session_start();
require("db_connection.php");

if (isset($_SESSION["UserID"])) {
    $statStmt = $conn->prepare("CALL sp_getUserStats(:userID)");
    $statStmt->execute(array('userID' => $_SESSION["UserID"]));
    $result = $statStmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}