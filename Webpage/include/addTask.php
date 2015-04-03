<?php
/**
 * Created by
 */
session_start();
require("db_connection.php");
echo $_POST['tasks'];
if (isset($_POST['tasks'])){
    $boardName = $_POST['tasks'];
    $ownerID = $_SESSION['UserID'];
    // Leiame Board-i id
    $stmtgetID = $conn->prepare("SELECT ID FROM Board WHERE Name = :boardName AND Owner_ID = :ownerID");
    $stmtgetID->execute(array('boardName' => $boardName, 'ownerID' => $ownerID));
    $result = $stmtgetID->fetch(PDO::FETCH_ASSOC);
    $boardID = $result['ID'];
    // The statement
    $array = $conn->prepare("CALL sp_newTask(:taskName, :taskDesc, :dueDate, :boardId)");
    $array->execute(array('taskName' => $_POST["name"], 'taskDesc' => $_POST["desc"], 'dueDate' => $_POST["DueDate"], 'boardId'=>$boardID));
}