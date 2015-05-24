<?php
include("include/session.php");
?>

<!DOCTYPE html>
<html manifest="/cache.manifest">
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="/lib/jquery-1.11.2.min.js"></script>
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
                <li><img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png"></li>
                <li id="account"></li>
                <li><a href="/help.php"><img class="help" src="images/help.png" alt="HELP"></a></li>
            </ul>
        </nav>
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