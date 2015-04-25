<?php
session_start();
require("db_connection.php");

function get_new_stuff($conn, $lastID, $procedure)
{
    $UserID = $_SESSION['UserID'];

    if ($procedure == 'Board') {
        $call = "CALL sp_checkNewBoards('$UserID', '$lastID')";
    } elseif ($procedure == 'Task') {
        parse_str(parse_url($_GET['boardURL'], PHP_URL_QUERY), $getName);
        $boardName = $getName['tasks'];

        // Mingi räme jant, et boardID kätte saada?
        $stm = $conn->prepare("CALL sp_getBoardID(:boardName, :UserID, @out_boardID)");
        $stm->bindParam(':boardName', $boardName, PDO::PARAM_STR);
        $stm->bindParam(':UserID', $UserID, PDO::PARAM_INT);
        $stm->execute();
        $stm->closeCursor();
        $r = $conn->query("SELECT @out_boardID")->fetch(PDO::FETCH_ASSOC);

        $boardID = $r['@out_boardID'];
        $call = "CALL sp_checkNewTasks('$boardID', '$lastID')";
    }

    $check_new = $conn->prepare($call);
    $check_new->execute();
    $count_new = $check_new->rowCount();

    $time = 0;

    while ($count_new <= 0) {
        if ($time == 10) {
            die(json_encode(array('status' => 'no-new', 'lastID' => $lastID)));
        } else {
            usleep(250000);
            $check_new = $conn->prepare($call);
            $check_new->execute();
            $count_new = $check_new->rowCount();
            $time += 1;
        }
    }

    $new = $check_new->fetchAll(PDO::FETCH_ASSOC);
    $last = end($new);
    $last_ID = $last['ID'];

    die(json_encode(array('status' => 'results', 'lastID' => $last_ID, 'data' => $new)));
}

if (isset($_GET['lastID']) && !empty($_GET['lastID'])) {
    $lastID = $_GET['lastID'];
    get_new_stuff($conn, $lastID, 'Board');
} elseif (isset($_GET['lastID_task']) && !empty($_GET['lastID_task'])) {
    $lastID = $_GET['lastID_task'];
    get_new_stuff($conn, $lastID, 'Task');
} elseif (!isset($_GET['boardURL'])) {
    get_new_stuff($conn, 0, 'Board');
} else {
    get_new_stuff($conn, 0, 'Task');
}
