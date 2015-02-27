<?php

define("HOST", "timeraft.cloudapp.net");
define("NAME", "timeraft");
define("USER", "jumal");
define("PASSWORD", "jumal1");

$connect = mysql_connect(HOST, USER, PASSWORD) or die("Could not connect to database." . mysql_error());
$db = mysql_select_db(NAME, $connect) or die("Could not connect to database." . mysql_error());
