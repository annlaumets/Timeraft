<?php
### Author : Andre
$iniArray = parse_ini_file("viktoriassecret.ini");

try {
    $conn = new PDO('mysql:host=timeraft.cloudapp.net;dbname='.$iniArray["DBNAME"].';charset=utf8', $iniArray["DBUSER"], $iniArray["DBUSERPW"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}