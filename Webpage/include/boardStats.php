<?php
/**
 * Created by Andre
 */
session_start();
require("db_connection.php");

if (isset($_GET["boardID"])) {
    $statStmt = $conn->prepare("CALL sp_getBoardStats(:boardID)");
    $statStmt->execute(array('boardID' => $_SESSION["boardID"]));
    $result = $statStmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}