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
                <li><a href="/mainboard" id="gotoMain">BOARDS</a></li>
                <li id="account"></li>

                <li><a href="/help"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
        <img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png">
    </header>
</section>

<div class="main-body">
    <select id="boardSelect">
    </select>
    <canvas id="diagramCanvas" height="400" width="400" style="float: left"></canvas>
</div>

</body>
</html>