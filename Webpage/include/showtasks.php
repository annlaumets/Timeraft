<?php

session_start();
require("db_connection.php");

if (isset($_GET['boardURL'])) {
    parse_str(parse_url($_GET['boardURL'], PHP_URL_QUERY), $getName);

    $boardName = $getName['tasks'];
    $ownerID = $_SESSION['UserID'];

    $getID = $conn->prepare("SELECT ID FROM Board WHERE Name = :boardName AND Owner_ID = :ownerID");
    $getID->execute(array('boardName' => $boardName, 'ownerID' => $ownerID));
    $result = $getID->fetch(PDO::FETCH_ASSOC);
    $boardID = $result['ID'];

    //file_put_contents('error.txt', $boardID, FILE_APPEND | LOCK_EX);
    $array = $conn->prepare("CALL sp_getTaskPerBoard('$boardID')");
    $array->execute();
    $data = $array->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}