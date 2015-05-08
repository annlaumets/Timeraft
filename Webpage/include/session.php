<?php
session_start();
//require("db_connection.php");

$checkUser = $_SESSION['loginUser'];

// Vana kood
//$checkStmt = $conn->query("SELECT Email FROM Users WHERE Email = '$checkUser'");
//$session = $checkStmt->fetch(PDO::FETCH_ASSOC);

//file_put_contents('error2.txt', $session, FILE_APPEND | LOCK_EX);
// Siit eemaldatud ka ifi teine osa, aga pole vaja seda
if(!(isset($_SESSION['login']))) {
    header("Location: index?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

