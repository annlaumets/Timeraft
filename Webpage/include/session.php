<?php
session_start();
require("db_connection.php");

$checkUser = $_SESSION['loginUser'];

$checkStmt = $conn->query("SELECT Email FROM Users WHERE Email = '$checkUser'");
$session = $checkStmt->fetch(PDO::FETCH_ASSOC);

if(!(isset($_SESSION['login'])) && !(isset($session))) {
    header("Location: index.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

