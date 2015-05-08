<?php
session_start();
require("db_connection.php");

$checkUser = $_SESSION['loginUser'];
$checkStmt = $conn->query("SELECT Name FROM Users WHERE Email = '$checkUser'");
$session = $checkStmt->fetch(PDO::FETCH_ASSOC);

if($_SESSION['login'] && !empty($session)) {
    echo strtoupper($session["Name"]);
    echo '<ul>';
    echo '<li><a href="/account">PROFILE</a></li>';
    echo '<li><a href="/settings">SETTINGS</a></li>';
    echo '<li><a href="/stats" id="stats">STATISTICS</a></li>';
    echo '<hr>';
    echo '<li><a href="/include/logout.php" id="logoutBtn">LOG OUT</a></li>';
    echo '</ul>';
}
