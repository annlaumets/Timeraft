<?php

session_start();

$check_user = $_SESSION['login_user'];
$query = mysql_query("SELECT Email FROM Users WHERE Email = '$check_user'");
$session = mysql_fetch_assoc($query)['Email'];

if(!(isset($_SESSION['login'])) && !(isset($session))) {
    header("Location: index.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

