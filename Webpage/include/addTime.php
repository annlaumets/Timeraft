<?php
/**
 * Created by Andre
 */
session_start();
require("db_connection.php");

if (isset($_GET["taskURL"])) {
    parse_str(parse_url($_GET['taskURL'], PHP_URL_QUERY), $getName);

    $taskID = $getName['taskID'];
    $ownerID = $_SESSION['UserID'];
    $boardName = $getName['tasks'];

    $getType = $conn->prepare("SELECT Task_Type FROM Task WHERE ID = :taskID");
    $getType->execute(array('taskID' => $taskID));

    $result = $getType->fetch(PDO::FETCH_ASSOC);
    $type = $result['Task_Type'];

    if ($type) {
        if ($type === "ToDo") {
            $array = $conn->prepare("CALL sp_startTask(:taskID, :taskTime)");
            $array->execute(array('taskID' => $taskID, 'taskTime' => $_GET["taskTime"]));
            echo $boardName;
        } elseif ($type === "Pending") {
            $array = $conn->prepare("CALL sp_pauseTask(:taskID, :taskTime)");
            $array->execute(array('taskID' => $taskID, 'taskTime' => $_GET["taskTime"]));
            echo $boardName;
        } elseif ($type === "Finished") {
            echo $_GET["taskTime"];
            $array = $conn->prepare("CALL sp_finishTask(:taskID, :taskTime)");
            $array->execute(array('taskID' => $taskID, 'taskTime' => $_GET["taskTime"]));
            //echo $boardName;
        } else {
            echo "TaskTime.php osas on suur viga.";
        }
    }
}