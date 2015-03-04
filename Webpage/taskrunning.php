<?php

include("include/session.php");

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'> <!--Font-->
    <script type="text/javascript" src="js/scripts.js"></script>
    <title>Timeraft</title>
</head>
<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li id="account">USERNAME
                    <ul>
                        <li><a href="/account.php">PROFILE</a></li>
                        <li><a href="/settings.php">SETTINGS</a></li>
                        <li><a href="/stats.php">STATISTICS</a></li>
                        <hr>
                        <li><a href="/include/logout.php">LOG OUT</a></li>
                    </ul>
                </li>
                <li><a href="/help.php"><img class="help" src="images/help.png" \></a></li>
            </ul>
        </nav>
        <img class="logo" src="images/timeraftlogo-white.png" \>
    </header>
</section>

<div class="main-body">

</div>

</body>
</html>