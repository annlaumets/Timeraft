<?php
include("include/session.php");
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html manifest="/cache.manifest">
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <script src="/lib/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/lib/jquery-ui-themes-1.11.3/themes/smoothness/jquery-ui.css" media="all">
    <script src="/lib/jquery-ui-1.11.2/jquery-ui.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>-->
    <script type="text/javascript" src="js/taskload.js"></script>
    <script type="text/javascript" src="js/getNewTask.js"></script>
    <script type="text/javascript" src="js/showusername.js"></script>
    <script type="text/javascript" src="js/delete.js"></script>
    <title>Timeraft | Board</title>
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

    <!-- Not started task popup -->
    <div id="popup_start">
        <div class="boarddesc">
            <img id="close_start" alt="X" src="images/close.png" onclick="div_hide_start()">
            <table>
                <tr><th>Name:</th></tr>
                <tr><th>Status:</th></tr>
                <tr><th>Description:</th></tr>
                <tr><th>Due date:</th></tr>
                <tr><th>Start Date:</th></tr>
                <tr><th>End date:</th></tr>
                <tr>
                    <th><input type="image" src="/images/delete.png" alt="DELETE" onclick="deleteTask(taskURL())"></th>
                    <th><input type="image" id="startbutt" src="/images/start.png" alt="START" onclick="location.href='/taskrunning.php?tasks=' + boardURL() + '&amp;taskID=' + taskURL()"></th>
                </tr>
            </table>
        </div>
    </div>

    <!-- Pending task popup -->
    <div id="popup_pending">
        <div class="boarddesc">
            <img id="close_pend" alt="X" src="images/close.png" onclick="div_hide_pending()">
            <table>
                <tr><th>Name:</th></tr>
                <tr><th>Status:</th></tr>
                <tr><th>Description:</th></tr>
                <tr><th>Due date:</th></tr>
                <tr><th>Start Date:</th></tr>
                <tr><th>End date:</th></tr>
                <tr><th>Time spent:</th></tr>
                <tr>
                    <th><input type="image" src="/images/delete.png" alt="DELETE" onclick="deleteTask(taskURL())"></th>
                    <th><input type="image" src="/images/continue.png" alt="CONTINUE" onclick="location.href='/taskrunning.php?tasks=' + boardURL() + '&amp;taskID=' + taskURL()"></th>
                </tr>
            </table>
        </div>
    </div>

    <!-- Finished task popup -->
    <div id="popup_finish">
        <div class="boarddesc">
            <img id="close_finish" alt="X" src="images/close.png" onclick="div_hide_finished()">
            <table>
                <tr><th>Name:</th></tr>
                <tr><th>Status:</th></tr>
                <tr><th>Description:</th></tr>
                <tr><th>Due date:</th></tr>
                <tr><th>Start Date:</th></tr>
                <tr><th>End date:</th></tr>
                <tr><th>Time spent:</th></tr>
                <tr><td><input type="image" src="/images/delete.png" alt="DELETE" onclick="deleteTask(taskURL())"></td></tr>
            </table>
        </div>
    </div>

    <!-- New task popup -->
    <div id="popup_newdesc">
        <form accept-charset="utf-8" action="/include/addTask.php" id="form_newtask" method="post" name="form_task">
            <img id="close_newtask" alt="X" src="images/close.png" onclick="div_hide_new()">
            <table>
                <tr><th>Name:</th><td><input name="name" type="text" size="20" required></td></tr>
                <tr><th>Description:</th><td><textarea name="desc" cols="18" rows="4"></textarea></td></tr>
                <tr><th>Due date:</th><td><input type="text" name="DueDate" id="datepick" required></td></tr>
                <tr><td colspan="2"><input name="submit" alt="CREATE" type="image" src="images/create.png" id="submit_newTask"></td></tr>
                <tr><td><input type="hidden" name="tasks"
                               value="<?php if (isset($_GET['tasks'])) echo htmlspecialchars($_GET['tasks']); ?>"></td></tr>
            </table>
        </form>
    </div>

    <div class="board">
        <div class="container">
            <div class="list">
                <img src="images/add.png" alt="+" id="addButton" onclick="div_show_new()">

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