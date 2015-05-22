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
    <title>Timeraft | Help</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li id="account"></li>
                <li><a href="/help.php"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
        <img class="logo" alt="TIMERAFT" src="/images/timeraftlogo-white.png">
    </header>
</section>

<div class="main-body">
    <ul id="accordion">
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I add a new board?</h2>
            <p class="phelp">1. Navigate to your main board page<br>
            2. Locate the plus ("+") button and click it<br>
            3. In a pop-up form fill out the fields. You have to add a board name, description is not required but it would be nice to know what that new board is all about<br>
            4. Click "Create" button</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I delete a board?</h2>
            <p class="phelp">1. Navigate to your main board page<br>
                2. Click on a board you want to delete<br>
                3. In a pop-up form click "Delete" button</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I change board settings?</h2>
            <p class="phelp">Sadly, this functionality is not available right now. You may always delete that board and make a new one if you have nothing to lose.</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I see my tasks?</h2>
            <p class="phelp">1. Make sure you are on your main board page<br>
                2. Click on a board the tasks of which you would like to see<br>
                3. In a pop-up form click "Show tasks" button</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I add a new task?</h2>
            <p class="phelp">...</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I delete a task?</h2>
            <p class="phelp">...</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I start a task?</h2>
            <p class="phelp">...</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I pause a task?</h2>
            <p class="phelp">...</p>
        </li>
        <li>
            <input class="helpinput" type="checkbox" checked>
            <i></i>
            <h2 class="h2help">How do I finish a task?</h2>
            <p class="phelp">...</p>
        </li>
    </ul>
</div>

</body>
</html>