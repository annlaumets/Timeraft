<?php
session_start();
require("db_connection.php");
date_default_timezone_set("Europe/Helsinki");

$ajax_timestamp = isset($_GET['timestamp']) ? date('Y-m-d H:i:s', $_GET['timestamp']) : null;
$lastID = isset($_GET['lastID']) && !empty($_GET['lastID']) ? $_GET['lastID'] : 0;
$UserID = $_SESSION['UserID'];

$statement = "SELECT * FROM Board WHERE Time_Created > :ajax_timestamp AND Owner_ID = :UserID";
$v = array('ajax_timestamp' => $ajax_timestamp, 'UserID' => $UserID);

if ($lastID != 0) {
    $statement .= ' AND ID > :lastID';
    $v[':lastID'] = $lastID;
}
//file_put_contents('error.txt', $ajax_timestamp, FILE_APPEND | LOCK_EX);
$check_new_boards = $conn->prepare($statement);
$check_new_boards->execute($v);
$count_new_boards = $check_new_boards->rowCount();

while ($count_new_boards <= 0) {
    usleep(25000);
    $check_new_boards = $conn->prepare($statement);
    $check_new_boards->execute($v);
    $count_new_boards = $check_new_boards->rowCount();
}

$new_boards = $check_new_boards->fetchAll(PDO::FETCH_ASSOC);
$last_board = end($new_boards);
$last_ID = $last_board['ID'];
die(json_encode(array('status' => 'results', 'timestamp' => time(), 'lastID' => $last_ID, 'data' => $new_boards)));

