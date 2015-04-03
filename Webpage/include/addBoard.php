<?php
/**
 * Created by Andre
 */

session_start();
require("db_connection.php");

if (isset($_POST["submit_x"])){
    $ownerID = $_SESSION['UserID'];
    $array = $conn->prepare("CALL sp_newBoard(:boardName, :boardDesc, :owner)");
    $array->execute(array('boardName' => $_POST["name"], 'boardDesc' => $_POST["desc"], 'owner' => $ownerID));
}

