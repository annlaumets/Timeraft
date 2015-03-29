<?php
session_start();
require("db_connection.php");

$owner_ID = $_SESSION['UserID'];

$array = $conn->prepare("CALL sp_getBoards('$owner_ID')");
$array->execute();
$data= $array->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);