<?php
/**
 * Created by Andre
 */
session_start();
require("db_connection.php");
if ($_GET["boardID"] > -1) {
    if ($_GET["boardID"] == 0) {
        $statStmt = $conn->prepare("CALL sp_getUserStats(:userID)");
        $statStmt->execute(array('userID' => $_SESSION["UserID"]));
        $result = $statStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        $statStmt = $conn->prepare("CALL sp_getBoardStats(:boardID)");
        $statStmt->execute(array('boardID' => $_GET["boardID"]));
        $result = $statStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
} else {
    echo "Stats error in boardStats.php";
}