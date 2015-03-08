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
    <script type="text/javascript" src="js/scripts.js"></script>
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
            <h3>Name: </h3><p>Board 1</p>
            <h3>Description:</h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in eros eros. Ut lobortis neque eget porta auctor. Curabitur eget maximus ex.</p>
            <a href="/board.php"><button id="boardsubmit">Show tasks</button></a>
        </div>
    </div>

    <div class="board">
        <div class="maincontainer">
            <div class="list">
                <div class="boardpcontainer">
                    <p onclick="div_show()">Board 1</p>
                </div>
            </div>
            <div class="list">
                <div class="boardpcontainer">
                    <p onclick="div_show()">Board 2</p>
                </div>
            </div>
            <div class="list">
                <div class="boardpcontainer">
                    <p onclick="div_show()">Board 3</p>
                </div>
            </div>
        </div>
        <div class="maincontainer">
            <div class="list">
                <div class="boardpcontainer">
                    <p onclick="div_show()">Board 4</p>
                </div>
            </div>
            <div class="list">
                <div class="boardpcontainer">
                    <p onclick="div_show()">Board 5</p>
                </div>
            </div>
            <div class="list">
                <div class="boardpcontainer">
                    <p><b>+</b></p>
                </div>
            </div>

        </div>
    </div>
</div>


</body>
</html>