<?php
/**
 * Created by
 */
session_start();
require("db_connection.php");

if (isset($_POST['tasks'])){
    $boardName = $_POST['tasks'];
    $ownerID = $_SESSION['UserID'];
    // Leiame Board-i id
    $stmtgetID = $conn->prepare("SELECT ID FROM Board WHERE Name = :boardName AND Owner_ID = :ownerID");
    $stmtgetID->execute(array('boardName' => $boardName, 'ownerID' => $ownerID));
    $result = $stmtgetID->fetch(PDO::FETCH_ASSOC);
    $boardID = $result['ID'];
    // The statement
    // $date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
    $formatDate = date('Y-m-d', strtotime(str_replace('-', '/', $_POST["DueDate"])));
    $array = $conn->prepare("CALL sp_newTask(:taskName, :taskDesc, :dueDate, :boardId)");
    $array->execute(array('taskName' => $_POST["name"], 'taskDesc' => $_POST["desc"], 'dueDate' => $formatDate, 'boardId'=>$boardID));
}