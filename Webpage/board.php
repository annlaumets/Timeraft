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
    <script type="text/javascript" src="js/taskload.js"></script>
    <script type="text/javascript" src="js/showusername.js"></script>
    <title>Timeraft | Board</title>
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
    <div id="form_signin"></div>

    <!-- Not started task popup -->
    <div id="popup_start">
        <div id="boarddesc">
            <img id="close_signin" src="images/close.png" onclick="div_hide_start()">
            <h3>Name: </h3>
            <h3>Status: </h3>
            <h3>Description: </h3>
            <h3>Due date: </h3>
            <h3>Start Date: </h3>
            <h3>End date: </h3>
            <input type="image" src="/images/start.png" alt="START" onclick="location.href='/taskrunning.php'">
        </div>
    </div>

    <!-- Pending task popup -->
    <div id="popup_pending">
        <div id="boarddesc">
            <img id="close_signin" src="images/close.png" onclick="div_hide_pending()">
            <h3>Name: </h3>
            <h3>Status: </h3>
            <h3>Description: </h3>
            <h3>Due date: </h3>
            <h3>Start Date: </h3>
            <h3>End date: </h3>
            <h3>Time spent: </h3>
            <input type="image" src="/images/continue.png" alt="CONTINUE" onclick="location.href='/taskrunning.php'">
        </div>
    </div>

    <!-- Finished task popup -->
    <div id="popup_finish">
        <div id="boarddesc">
            <img id="close_signin" src="images/close.png" onclick="div_hide_finished()">
            <h3>Name: </h3>
            <h3>Status: </h3>
            <h3>Description: </h3>
            <h3>Due date: </h3>
            <h3>Start Date: </h3>
            <h3>End date: </h3>
            <h3>Time spent: </h3>
        </div>
    </div>

    <!-- New task popup -->
    <div id="form_signin"></div>
    <div id="popup_newdesc">
        <form accept-charset="utf-8" action="/include/addTask.php" id="form2_signin" method="post" name="form_task">
            <img id="close_signin" src="images/close.png" onclick="div_hide_new()">
            <table>
                <tr>
                    <th>Name:</th>
                    <td><input name="name" type="text" size="20" required></td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td><textarea name="desc" cols="18" rows="4"></textarea></td>
                </tr>
                <tr>
                    <th>Due date:</th>
                    <td><input type="date"></td>
                </tr>
                <tr>
                    <td colspan="2"><input onsubmit="div_hide_new()" name="submit" alt="CREATE" type="image" src="images/create.png" id="submit_newTask" align="center"></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="board">
        <div class="container">
            <div class="list">
                <img src="images/add.png" alt="+" id="addButton" onclick="div_show_new()">
                <h3 id="adding">To Do</h3>
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