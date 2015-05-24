<?php
include("include/session.php");
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="/lib/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/showusername.js"></script>
    <script type="text/javascript" src="js/populatefields.js"></script>
    <title>Timeraft | Settings</title>
</head>

<body>
<section>
    <header>
        <nav>
            <ul>
                <li><a href="/mainboard.php">BOARDS</a></li>
                <li><img class="logo" alt="TIMERAFT" src="images/timeraftlogo-white.png"></li>
                <li id="account"></li>
                <li><a href="/help.php"><img class="help" alt="HELP" src="images/help.png"></a></li>
            </ul>
        </nav>
    </header>
</section>;

<div class="main-body">
    <form id="changeSettings" action="/include/updateUserInfo.php" method="post" enctype="multipart/form-data">
        <table id="tableSettings">
            <tr>
                <td>Select image to upload:</td>
                <td><div id="picUpload">
                        <input type="file" id="fileID" name="fileChange">
                    </div>
                    <input type="image" id="imgClicktoUpload" src="/images/choosefile.png" alt="Choose file"
                        onclick="document.getElementById('fileID').click(); return false;">
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="nameChange" id="nameID"></td>
            </tr>
            <tr>
                <td>Biography:</td>
                <td><textarea name="bioChange" id="bioID" wrap="soft"></textarea></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="newpw1" id="newpwID" placeholder="New password" size="22">
                    <input type="password" name="newpw2" id="newpw2ID" placeholder="Re-type new password" size="22">
                </td>
            </tr>
            <tr>
                <td colspan="2">To apply changes, please type in your password. <br>
                    In case you want to change the password, type in your old password. <br>
                    <br>
                    <input type="password" name="oldpw" id="oldpwID"
                                       placeholder="Please insert old password" required="required"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="image" name="Submit" src="/images/changeaccount.png" alt="Change account"></td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>