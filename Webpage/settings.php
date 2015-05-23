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
    <title>Timeraft | Settings</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png">
                <li id="account"></li>
                <li><a href="/help.php"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
    </header>
</section>

<div class="main-body">
    <form id="changeSettings" action="/include/updateUserInfo.php" method="post" enctype="multipart/form-data">
        <table id="tableSettings">
            <tr>
                <td>Select image to upload:</td>
                <td><a href="#" onclick="document.getElementById('fileID').click(); return false;" />
                    <img id="imgChange" alt="choose file" src="/images/choosefile.png"></a>
                    <input type="file" name="picChange" id="fileID"></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="nameChange"></label></td>
            </tr>
            <tr>
                <td>Biography:</td>
                <td><input type="text" name="bioChange"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="oldpw1">
                    <input type="password" name="oldpw2">
                    <input type="password" name="newpw">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="image" name="Submit" value="Submit" src="/images/changeaccount.png"></td>
            </tr>
        </table>
    </form>
    <!--nime, parooli ja lühitutvustust-->
</div>

</body>
</html>