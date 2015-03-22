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
    <script type="text/javascript" src="js/showusername.js"></script>
    <script type="text/javascript" src="js/boardload.js"></script>
    <title>Timeraft | Main Board</title>
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
    <div id="form_signin"></div>
    <div id="popup_desc">
        <div id="boarddesc">
            <img id="close_signin" src="images/close.png" onclick="div_hide()">
            <h3>Name: </h3>
            <h3>Description:</h3>
            <a href="/board.php"><button id="boardsubmit">Show tasks</button></a>
        </div>
    </div>

    <div class="board">
        <div class="maincontainer">

        </div>
        <div class="maincontainer">

        </div>
    </div>
</div>


</body>
</html>