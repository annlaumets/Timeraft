<?php
/**
 * Created by Andre
 */
session_start();
require("db_connection.php");
if (isset($_GET["boardID"])) {
    if ($_GET["boardID"] = 0 && isset($_SESSION["UserID"])) {
        $statStmt = $conn->prepare("CALL sp_getUserStats(:userID)");
        $statStmt->execute(array('userID' => $_SESSION["UserID"]));
        $result = $statStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        $statStmt = $conn->prepare("CALL sp_getBoardStats(:boardID)");
        $statStmt->execute(array('userID' => $_GET["boardID"]));
        $result = $statStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
} else {
    echo "Stats error in boardStats.php";
}