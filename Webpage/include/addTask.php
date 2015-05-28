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
    $stm = $conn->prepare("CALL sp_getBoardID(:boardName, :ownerID, @out_boardID)");
    $stm->bindParam(':boardName', $boardName, PDO::PARAM_STR);
    $stm->bindParam(':ownerID', $ownerID, PDO::PARAM_INT);
    $stm->execute();
    $stm->closeCursor();
    $r = $conn->query("SELECT @out_boardID")->fetch(PDO::FETCH_ASSOC);
    $boardID = $r['@out_boardID'];
    // The statement
    // $date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
    $formatDate = date('Y-m-d', strtotime(str_replace('/', '-', $_POST["DueDate"])));
    $array = $conn->prepare("CALL sp_newTask(:taskName, :taskDesc, :dueDate, :boardId)");
    $array->execute(array('taskName' => $_POST["name"], 'taskDesc' => $_POST["desc"], 'dueDate' => $formatDate, 'boardId'=>$boardID));
}