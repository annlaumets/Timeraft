<?php
session_start();
require("db_connection.php");

$owner_Email = $_SESSION['loginUser'];
// file_put_contents("boardtest.txt", $owner_Email, FILE_APPEND | LOCK_EX);

$array = array(
    array(
        "Name" => "OOP",
        "Description" => "Project for OOP"),
    array(
        "Name" => "Chem",
        "Description" => "Chemistry homework"),
    array(
        "Name" => "Math",
        "Description" => "")
    );

echo json_encode($array);