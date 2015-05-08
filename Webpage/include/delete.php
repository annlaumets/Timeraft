<?php

session_start();
require("db_connection.php");

function delete_board($conn, $user_ID, $board_name) {
    $delete = $conn->prepare("CALL sp_deleteBoard('$user_ID', '$board_name')");
    $delete->execute();
}

function delete_task($conn, $taskID) {
    $delete = $conn->prepare("CALL sp_deleteTask('$taskID')");
    $delete->execute();
}

$user_ID = $_SESSION['UserID'];

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'board' && isset($_POST['name'])) {
        $board_name = $_POST['name'];
        delete_board($conn, $user_ID, $board_name);
    } elseif ($_POST['type'] == 'task' && isset($_POST['name'])) {
        $task_ID = $_POST['name'];
        delete_task($conn, $task_ID);
    }
}
