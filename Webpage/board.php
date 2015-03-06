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
    <title>Timeraft | Board</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li id="account">

                <li><a href="/help.php"><img class="help" src="images/help.png" \></a></li>
            </ul>
        </nav>
        <img class="logo" src="images/timeraftlogo-white.png" \>
    </header>
</section>

<div class="main-body">
    <div class="board">
        <div class="container">
            <div class="list">
                <h3>To Do</h3>
                <hr>
                <p>Test 1</p>
                <p>Test 2</p>
            </div>
            <div class="list">
                <h3>Pending</h3>
                <hr>
                <p>Test 3</p>
                <p>Test 4</p>
            </div>
            <div class="list">
                <h3>Finished</h3>
                <hr>
                <p>Test 5</p>
                <p>Test 6</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>