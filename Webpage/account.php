<?php
include("include/session.php");
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'> <!--Font-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> <!-- JQuery library -->
    <script type="text/javascript" src="js/showusername.js"></script>
    <script type="text/javascript" src="js/accountload.js"></script>
    <title>Timeraft | Account</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li id="account">
                <li><a href="/help.php"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
        <img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png">
    </header>
</section>

<div class="main-body">
    <div class="accountcontainer">
        <div class="imgcontainer">
            <img class="profile" alt="PROFILE PICTURE" src="http://placehold.it/175x250/0099FF/000000">
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