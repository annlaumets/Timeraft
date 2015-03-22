<?php

session_start();

require("db_connection.php");

$owner_Email = $_SESSION['loginUser'];
// file_put_contents("boardtest.txt", $owner_Email, FILE_APPEND | LOCK_EX);


$array = array(
    array(
        "Name" => "OOP",
        "Description" => "Project for OOP",
        "Type" => "To Do",
        "Time" => "00:00:00"
    ),
    array(
        "Name" => "Chem",
        "Description" => "Chemistry homework",
        "Type" => "Pending",
        "Time" => "00:32:27"
    ),
    array(
        "Name" => "Math",
        "Description" => "",
        "Type" => "To Do",
        "Time" => "00:00:00"
    ),
    array(
        "Name" => "Veebirakendused",
        "Description" => "Projekti lõpetamine",
        "Type" => "Finished",
        "Time" => "01:16:09"
    )
);

echo json_encode($array);