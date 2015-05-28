<?php
session_start();
require("db_connection.php");

$sessUserId = $_SESSION['UserID'];

$checkStmt = $conn->prepare("SELECT Name FROM Users WHERE ID = :uid");
$checkStmt -> execute(array('uid' => $sessUserId));
$session = $checkStmt->fetch(PDO::FETCH_ASSOC);

if($_SESSION['login'] && !empty($session)) {
    echo strtoupper($session["Name"]);
}
