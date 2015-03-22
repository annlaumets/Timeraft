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
    <script type="text/javascript" src="js/showusername.js"></script>
    <title>Timeraft | Account</title>
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
    <div class="accountcontainer">
        <div class="imgcontainer">
            <img class="profile" alt="PROFILE PICTURE" src="http://placehold.it/175x250/0099FF/000000">
        </div>
        <div class="datacontainer">
            <h4>Name</h4>
            <p onclick="">Annika</p>
            <h4>Email address</h4>
            <p>someone@example.com</p>
            <h4>Biography</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque consectetur imperdiet odio. Integer tempus ultricies pellentesque. Donec viverra ex ex, vitae pulvinar magna sodales imperdiet. Aliquam imperdiet eros in mi viverra, vel aliquam lorem cursus. Sed non enim non metus cursus blandit in non odio. Duis viverra neque id ex tincidunt, volutpat accumsan quam commodo. Nam et purus lectus. Suspendisse potenti. Vivamus suscipit tortor neque, a luctus lorem accumsan ut. Nulla dapibus est tortor, eu efficitur leo pharetra non.</p>
            <h4>Total time spent:</h4>
            <p>25 hours 45 minutes 7 seconds</p>
        </div>
    </div>
</div>
</body>
</html>