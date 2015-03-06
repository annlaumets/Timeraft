<?php

session_start();

require_once("db_connection.php");

$check_user = $_SESSION['login_user'];
$query = mysql_query("SELECT Name FROM Users WHERE Email = '$check_user'") or die("yo");
$session = mysql_fetch_assoc($query)['Name'];

if($_SESSION['login'] && !empty($session)) {
    echo strtoupper($session);
    echo '<ul>';
    echo '<li><a href="/account.php">PROFILE</a></li>';
    echo '<li><a href="/settings.php">SETTINGS</a></li>';
    echo '<li><a href="/stats.php">STATISTICS</a></li>';
    echo '<hr>';
    echo '<li><a href="/include/logout.php">LOG OUT</a></li>';
    echo '</ul>';
    echo '</li>';
}
