<?php

session_start();
require("db_connection.php");

if (isset($_GET['boardURL'])) {
    parse_str(parse_url($_GET['boardURL'], PHP_URL_QUERY), $getName);

    $boardName = $getName['tasks'];
    $ownerID = $_SESSION['UserID'];

    $stm = $conn->prepare("CALL sp_getBoardID(:boardName, :ownerID, @out_boardID)");
    $stm->bindParam(':boardName', $boardName, PDO::PARAM_STR);
    $stm->bindParam(':ownerID', $ownerID, PDO::PARAM_INT);
    $stm->execute();
    $stm->closeCursor();
    $r = $conn->query("SELECT @out_boardID")->fetch(PDO::FETCH_ASSOC);
    $boardID = $r['@out_boardID'];

    //file_put_contents('error.txt', $boardID, FILE_APPEND | LOCK_EX);
    $array = $conn->prepare("CALL sp_getTaskPerBoard('$boardID')");
    $array->execute();
    $data = $array->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}