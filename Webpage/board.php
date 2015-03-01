<?php

include("include/session.php");

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="js/scripts.js"></script>
    <title>Timeraft | Board</title>
</head>
<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="mainboard.html">Boards</a></li>
                <li id="account">Username
                    <ul>
                        <li><a href="account.html">Profile</a></li>
                        <li><a href="settings.html">Settings</a></li>
                        <li><a href="stats.html">Statistics</a></li>
                        <hr><li><a href="/include/logout.php">Log out</a></li>
                    </ul>
                </li>
                <li><a href="help.html"><img class="help" src="images/Question_mark.png" \></a></li>
            </ul>
        </nav>
        <div class="logo"></div>
    </header>
</section>

</body>
</html>