<?php
/**
 * Created by Andre
 */
session_start();
require("db_connection.php");

if (isset($_GET["taskURL"])) {
    parse_str(parse_url($_GET['taskURL'], PHP_URL_QUERY), $getName);
    file_put_contents("error2.txt", $_GET['taskURL'], FILE_APPEND);
    $taskID = $getName['taskID'];
    $boardName = $getName['tasks'];

    if ($_GET["type"] === "pause") {
        $array = $conn->prepare("CALL sp_pauseTask(:taskID, :taskTime)");
        $array->execute(array('taskID' => $taskID, 'taskTime' => $_GET["taskTime"]));
        echo $boardName;
    } elseif ($_GET["type"] === "stop") {
        $array = $conn->prepare("CALL sp_finishTask(:taskID, :taskTime)");
        $array->execute(array('taskID' => $taskID, 'taskTime' => $_GET["taskTime"]));
        echo $boardName;
    } else {
        file_put_contents("error.txt", "type vale, else osas olen \n", FILE_APPEND);
        echo $boardName;
    }
} else {
    file_put_contents("error.txt", "ADDTIME else osa error, peaks uurima, data on selline: ".$_GET, FILE_APPEND);
}