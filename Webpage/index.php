<?php

header('Content-Type: text/html; charset=UTF-8'); //et näitaks täpitähti :D

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/loginproov.js"></script>

    <title>Timeraft</title>
</head>

<body>
<div id="fb-root"></div>
<section>
    <header>
        <a href=#1><img class="logo-main" alt="TIMERAFT" src="images/timeraftlogo-white.png"/></a>
        <nav>
            <ul class="ul2">
                <li class="li2"><a href=#2>FEATURES</a></li>
                <li class="li2"><a href=#3>ABOUT US</a></li>
            </ul>
        </nav>
    </header>
</section>


<div class="main-body">
    <a name=1></a>
    <section id="timeraft">

        <img src="images/timeraftlogo.png" alt="TIMERAFT" id="mainpage-logo">
        <br>
        <h3>Timeraft gives you a perfect oppurtunity to start managing your daily tasks online with good statistical analysis tools.<br>
            <br>
            Stop using your fridge as a noteboard and join Timeraft community, you will not regret it.</h3>
        <div id="form_signin"></div>
        <div id="popup_signin">
            <form accept-charset="utf-8" action="/include/login.php" id="form2_signin" method="post" name="form2">
                <img id="close_signin" alt="X" src="images/close.png" onclick="div_hide_signin()">

                <h2>SIGN IN</h2>
                <br>
                <input name="email" placeholder="Email" type="email" size="25" required>
                <input name="password" placeholder="Password" type="password" size="25" required>
                <input onsubmit="div_hide_signin()" name="submit"  type="image" alt="LOG IN" src="images/login.png" id="submit_signin">

                <div class="nupud">
                    <div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="false" scope="public_profile, email"></div>
                    <div id="status"></div>
                </div>
            </form>
        </div>
        <input type="image" alt="SIGN IN" onclick="div_show_signin()" src="images/signin.png" />

        <div id="form_signup"></div>
        <div id="popup_signup">
            <form accept-charset="utf-8" action="/include/signup.php" id="form2_signup" method="post" name="form2">
                <img id="close_signup" alt="X" src="images/close.png" onclick="div_hide_signup()">

                <h2>SIGN UP</h2>
                <br>
                <input name="name" placeholder="Name" type="text" size="25" required>
                <input name="email" placeholder="Email" type="email" size="25" required>
                <input name="password" placeholder="Password" type="password" size="25" required>
                <input onsubmit="div_hide_signup()" name="submit" type="image" alt="REGISTER" src="images/register.png" id="submit_signup">

                <div class="nupud">
                    <!--<fb:login-button scope="public_profile,email" onclick="checkLoginState();">
                    </fb:login-button>-->
                    <div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="false"></div>
                </div>
            </form>
        </div>
        <input type="image" alt="SIGN UP" src="images/signup.png" onclick="div_show_signup()"/>
    </section>


    <a name=2></a>
    <section id="features">

        <h1>FEATURES</h1>
        <ul>
            <li>Use facebook, google+ or twitter for easy login</li>
            <li>Create boards and manage them</li>
            <li>Create tasks and track how much time you spend on them</li>
            <li>Analyse time spent</li>
        </ul>
    </section>

    <a name=3></a>
    <section id="aboutus">

        <h1>ABOUT US</h1>

        <p>TIMERAFT Team: 3 2nd year Bachelor students from University of Tartu studying IT. <br>
            Development was done by all of us with 2 or 3 meetings per week, team leader is Annika Laumets.</p>
        <ul>
            <li>Annika Laumets - rockstar front-end developer, with quick fingers because I play the piano</li>
            <li>Viktoria Plemakova - When not sleepy, I am a legendary front-end/back-end developer</li>
            <li>Andre Tättar - Very skilled with servers and back-end, I get confused by HTML code</li>
        </ul>
        <p>Contact us by email: annika.laumets@ut.ee</p>
    </section>
</div>
</body>
</html>