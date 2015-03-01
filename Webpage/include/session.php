<?php

session_start();

require_once("db_connection.php");

$check_user = $_SESSION['login_user'];

$query = mysql_query("SELECT Email FROM Users WHERE Email = '$check_user'");
$row = mysql_fetch_assoc($query);

if(!isset($row['Email'])){
    header('Location: index.php');
    exit();
}
