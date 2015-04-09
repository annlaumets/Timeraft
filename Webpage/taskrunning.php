<?php
include("include/session.php");
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> <!-- JQuery library -->
    <script type="text/javascript" src="js/timer.js"></script>
    <script type="text/javascript" src="js/showusername.js"></script>
    <title>Timeraft</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li id="account">

                <li><a href="/help.php"><img class="help" src="images/help.png" alt="HELP"></a></li>
            </ul>
        </nav>
        <img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png">
    </header>
</section>

<div class="main-body">
    <div class="timercontainer">
        <h1 id="timer2">00:00:00</h1>
        <input id="pause2" name="controls" type="image" src="images/pause.png" alt="PAUSE">
        <input id="stop2" name="controls" type="image" src="images/stop.png" alt="STOP">
    </div>

</div>

</body>
</html>