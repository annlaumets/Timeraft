<?php
### Author : Andre
$iniArray = parse_ini_file("viktoriassecret.ini");

try {
    $conn = new PDO('mysql:host=timeraft.cloudapp.net;dbname='.$iniArray["DBNAME"].';charset=utf8', $iniArray["DBUSER"], $iniArray["DBUSERPW"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    file_get_contents("dbError.txt",'ERROR: ' . $e->getMessage(),FILE_APPEND);
    die("db connection error");
}