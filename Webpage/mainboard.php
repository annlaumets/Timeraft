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
    <script type="text/javascript" src="js/boardload.js"></script>
    <script type="text/javascript" src="js/getNewBoard.js"></script>
    <script type="text/javascript" src="js/delete.js"></script>
    <title>Timeraft | Main Board</title>
</head>

<body>
<section>
    <header>
        <nav id="main-nav">
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li><img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png"></li>
                <li id="account">
                    <ul>
                        <li><a href="/account.php">PROFILE</a></li>
                        <li><a href="/settings.php">SETTINGS</a></li>
                        <li><a href="/stats.php">STATISTICS</a></li>
                        <li class="with-line"><a href="/include/logout.php">LOG OUT</a></li>
                    </ul>
                </li>
                <li><a href="/help.php"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>

        <nav id="mobile-nav">
            <ul>
                <li><img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png"></li>
                <li id="account2">
                <ul>
                    <li><a href="/account.php">PROFILE</a></li>
                    <li><a href="/settings.php">SETTINGS</a></li>
                    <li><a href="/stats.php">STATISTICS</a></li>
                    <li><a href="/mainboard.php">BOARDS</a></li>
                    <li><a href="/help.php">HELP</a></li>
                    <li class="with-line"><a href="/include/logout.php">LOG OUT</a></li>
                </ul>
                </li>
            </ul>
        </nav>
    </header>
</section>


<div class="main-body">
    <div id="form_popup"></div>

    <!-- Board popup -->
    <div id="popup_desc">
        <div class="boarddesc">
            <img id="close_desc" alt="X" src="images/close.png" onclick="div_hide()">
            <table>
                <tr><th>Name:</th></tr>
                <tr><th>Description:</th></tr>
                <tr>
                    <th><input type="image" name="delBoard" src="/images/delete.png" alt="DELETE BOARD" onclick="deleteBoard(boardURL())"></th>
                    <th><input type="image" name="tasks" src="/images/showtasks.png" alt="SHOW TASKS" onclick="location.href='/board.php?tasks=' + boardURL()"></th>
                </tr>
            </table>
        </div>
    </div>

    <!-- New board popup -->
    <div id="popup_newdesc">
        <form accept-charset="utf-8" action="/include/addBoard.php" id="form_newboard" method="post" name="form_board">
            <img id="close_newdesc" alt="X" src="images/close.png" onclick="div_hide_new()">
            <table>
                <tr><th>Name:</th><td><label><input name="name" type="text" size="20" required></label></td></tr>
                <tr><th>Description:</th><td><label><textarea name="desc" cols="18" rows="4"></textarea></label></td></tr>
                <tr><td colspan="2"><input name="submit" alt="CREATE" type="image" src="images/create.png" id="submit_newBoard"></td></tr>
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