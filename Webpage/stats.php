<?php
include("include/session.php");
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html manifest="/cache.manifest">
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="/lib/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/showusername.js"></script>
    <script type="text/javascript" src="js/diagramload.js"></script>
    <title>Timeraft | Statistics</title>
</head>
<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php" id="gotoMain">BOARDS</a></li>
                <img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png">
                <li id="account"></li>
                <li><a href="/help.php"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
    </header>
</section>

<div class="main-body">
    <canvas id="diagramCanvas" height="400" width="400"></canvas>
    <br>
    <select id="boardSelect"></select>
</div>

</body>
</html>