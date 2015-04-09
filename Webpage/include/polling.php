<?php
session_start();
require("db_connection.php");

$lastID = isset($_GET['lastID']) && !empty($_GET['lastID']) ? $_GET['lastID'] : 0;
$UserID = $_SESSION['UserID'];

$check_new_boards = $conn->prepare("SELECT * FROM Board WHERE ID > :lastID AND Owner_ID = :UserID");
$check_new_boards->execute(array('lastID' => $lastID, 'UserID' => $UserID));
$count_new_boards = $check_new_boards->rowCount();

$time = 0;

while ($count_new_boards <= 0) {
    if ($time == 10) {
        die(json_encode(array('status' => 'no-new-boards', 'lastID' => $lastID)));
    } else {
        usleep(250000);
        $check_new_boards = $conn->prepare("SELECT * FROM Board WHERE ID > :lastID AND Owner_ID = :UserID");
        $check_new_boards->execute(array('lastID' => $lastID, 'UserID' => $UserID));
        $count_new_boards = $check_new_boards->rowCount();
        $time += 1;
    }
}

$new_boards = $check_new_boards->fetchAll(PDO::FETCH_ASSOC);
$last_board = end($new_boards);
$last_ID = $last_board['ID'];
die(json_encode(array('status' => 'results', 'lastID' => $last_ID, 'data' => $new_boards)));
