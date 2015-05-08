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
    <script type="text/javascript" src="js/accountload.js"></script>
    <title>Timeraft | Account</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard">BOARDS</a></li>
                <li id="account"></li>
                <li><a href="/help"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
        <img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png">
    </header>
</section>

<div class="main-body">
    <div class="accountcontainer">
        <div class="imgcontainer">
            <img class="profile" alt="PROFILE PICTURE" src="/images/placeholder.png">
        </div>
        <div class="datacontainer">
            <h4>Name:</h4>
            <h4>Email address:</h4>
            <h4>Biography:</h4>
            <h4>Total time spent:</h4>
        </div>
    </div>
</div>
</body>
</html>