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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/taskload.js"></script>
    <title>Timeraft | Board</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li id="account">

                <li><a href="/help.php"><img class="help" src="images/help.png"></a></li>
            </ul>
        </nav>
        <img class="logo" src="images/timeraftlogo-white.png">
    </header>
</section>

<div class="main-body">
    <div class="board">
        <div class="container">
            <div class="list">
                <h3>To Do</h3>
                <hr>
                <div class="boardpcontainer">

                </div>
            </div>
        </div>
        <div class="container">
            <div class="list">
                <h3>Pending</h3>
                <hr>
                <div class="boardpcontainer">

                </div>
            </div>
        </div>
        <div class="container">
            <div class="list">
                <h3>Finished</h3>
                <hr>
                <div class="boardpcontainer">

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>