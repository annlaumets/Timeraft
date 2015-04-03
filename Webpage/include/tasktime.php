<?php
/**
 * Created by Andre
 */
session_start();
require("db_connection.php");

if (isset($_POST["type"])) {
    if ($_POST["type"]==="start") {
        $array = $conn->prepare("CALL sp_startTask(:taskID, :taskTime)");
        $array->execute(array('taskId' => $_POST["taskID"], 'taskTime' => $_POST["taskTime"]));
    } elseif ($_POST["type"]==="pause") {
        $array = $conn->prepare("CALL sp_pauseTask(:taskID, :taskTime)");
        $array->execute(array('taskId' => $_POST["taskID"], 'taskTime' => $_POST["taskTime"]));
    } elseif ($_POST["type"]==="finish"){
        $array = $conn->prepare("CALL sp_finishTask(:taskID, :taskTime)");
        $array->execute(array('taskId' => $_POST["taskID"], 'taskTime' => $_POST["taskTime"]));
    } else {
        echo "TaskTime.php osas on suur viga.";
    }
}