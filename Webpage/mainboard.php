<?php
include("include/session.php");
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'>
    <!--Font-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- JQuery library -->
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
                <li><a href="/help.php"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
        <img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png">
    </header>
</section>


<div class="main-body">
    <div id="form_popup"></div>

    <!-- Board popup -->
    <div id="popup_desc">
        <div class="boarddesc">
            <img id="close_desc" alt="X" src="images/close.png" onclick="div_hide()">

            <h3>Name: </h3>

            <h3>Description:</h3>
            <input type="image" name="tasks" src="/images/showtasks.png" alt="SHOW TASKS"
                   onclick="location.href='/board.php?tasks=' + boardURL()">
        </div>
    </div>

    <!-- New board popup -->
    <div id="popup_newdesc">
        <form accept-charset="utf-8" action="/include/addBoard.php" id="form_newboard" method="post" name="form_board">
            <img id="close_newdesc" alt="X" src="images/close.png" onclick="div_hide_new()">
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
                    <td colspan="2"><input onsubmit="div_hide_new()" name="submit" alt="CREATE" type="image"
                                           src="images/create.png" id="submit_newBoard"></td>
                </tr>
            </table>
        </form>
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