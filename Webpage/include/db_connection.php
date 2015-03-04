<?php

$iniArray = parse_ini_file("viktoriassecret.ini");

define("HOST", "timeraft.cloudapp.net");
define("NAME", $iniArray["DBNAME"]);
define("USER", $iniArray["DBUSER"]);
define("PASSWORD", $iniArray["DBUSERPW"]);

$connect = mysql_connect(HOST, USER, PASSWORD) or die("Could not connect to database." . mysql_error());
$db = mysql_select_db(NAME, $connect) or die("Could not connect to database." . mysql_error());