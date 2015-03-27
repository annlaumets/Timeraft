<?php
session_start();
require("db_connection.php");

$owner_Email = $_SESSION['loginUser'];
$owner_ID = $_SESSION['UserID'];
// file_put_contents("boardtest.txt", $owner_Email, FILE_APPEND | LOCK_EX);

$array = $conn->prepare("CALL sp_getBoards('$owner_ID')");
$array->execute();
$data= $array->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);