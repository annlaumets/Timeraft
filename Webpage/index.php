<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="scripts.js"></script>
    <title>Timeraft</title>
</head>

<body>
<div class="header">
    <a href=#1><img class="logo-main" src="paasukelogo2.jpg"/></a>
    <nav>
        <ul>
            <li><a href=#2>Features</a></li>
            <li><a href=#2>About us</a></li>
        </ul>
    </nav>
</div>


<div class="main-body">
    <a name=1></a><h1>Timeraft</h1>
    <img src="paasukelogo2.jpg"/>

    <div id="form_signin">
        <div id="popup_singin">
            <form action="/include/login.php" id="form2_signin" method="post" name="form2">
                <img id="close_signin" src="paasukelogo2.jpg" onclick ="div_hide_signin()">
                <h2>Sign in</h2>
                <hr>
                <input id="name_signin" name="name" placeholder="Name" type="text">
                <input id="password_signin" name="password" placeholder="Password" type="password">
                <input onclick="div_hide_signin()" name="submit" value="Log in" type="submit">
            </form>
        </div>
    </div>
    <button onclick="div_show_signin()">Sign in</button>

    <div id="form_signup">
        <div id="popup_singup">
            <form action="#" id="form2_signup" method="post" name="form2">
                <img id="close_signup" src="paasukelogo2.jpg" onclick ="div_hide_signup()">
                <h2>Sign up</h2>
                <hr>
                <input id="name_signup" name="name" placeholder="Name" type="text">
                <input id="email_signup" name="email" placeholder="Email" type="email">
                <input id="password_signup" name="password" placeholder="Password" type="password">
                <input name="submit" value="Submit" type="submit">
            </form>
        </div>
    </div>
    <button onclick="div_show_signup()">Sign up</button>




    <a name=2></a><h1>Features</h1>
    <p id="demo">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed dignissim metus. Cras eleifend a sem ac bibendum. Nam fringilla volutpat sollicitudin. Nullam non dictum metus. Aliquam erat volutpat. In vel interdum lorem. Nullam et leo pretium, congue sem suscipit, viverra nibh. Aliquam lacinia ultricies odio, et luctus eros sollicitudin at. Phasellus vitae augue feugiat, mattis augue id, elementum magna.

        Fusce vitae leo sed magna molestie facilisis. Praesent scelerisque tortor urna, a elementum tellus dignissim sed. Duis tincidunt quam dui, vel ultricies justo facilisis sit amet. Nulla molestie iaculis felis, vel pharetra mauris congue a. Integer pharetra mauris sed enim efficitur dignissim. Quisque luctus lectus ac lorem laoreet, sit amet fringilla neque iaculis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque magna quam, blandit eu maximus ac, luctus sed tortor. Proin posuere ullamcorper dui sit amet dignissim. Mauris efficitur vulputate dictum. Vivamus sagittis tincidunt magna et ultricies.

        Vivamus varius vitae urna quis varius. Mauris iaculis dignissim lectus, eu aliquet mi. Donec eleifend elementum mattis. Proin lobortis, libero eu dapibus tincidunt, diam ex blandit mi, et venenatis arcu felis sit amet dolor. Integer volutpat lectus quis venenatis malesuada. Mauris hendrerit velit ut dui aliquet venenatis. Praesent venenatis eget felis nec consectetur. Quisque consequat ante sed fringilla sodales. Quisque porta risus eu elit auctor laoreet. Sed efficitur metus erat, eget porta ex gravida eget.

        Integer vitae aliquet lorem. Maecenas eget risus tempus, pellentesque eros eu, facilisis urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris vehicula orci nisl, quis venenatis eros porta a. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent mattis et ipsum eu sagittis. Aliquam tincidunt magna id semper molestie. Integer ac tortor quis nunc hendrerit posuere ut sed nunc. Nullam porttitor libero ullamcorper finibus pellentesque. Aenean porttitor nibh ac urna accumsan porta. Vestibulum in velit tellus. Ut auctor dignissim placerat. Nullam finibus purus in ex tincidunt egestas. Curabitur rutrum ultrices enim nec commodo. Nulla scelerisque leo et lectus sollicitudin, vitae ultrices ligula porta. Morbi a eleifend sem.

        Sed tristique quam tellus. Sed sed laoreet magna. Vivamus ut interdum augue, eu venenatis quam. Duis mattis dignissim nunc sit amet mollis. Nullam in libero luctus, pellentesque augue aliquet, mollis nisl. Curabitur vitae velit id nulla malesuada pharetra vel quis ante. Morbi luctus molestie pharetra. Phasellus porttitor, arcu fermentum euismod pharetra, neque arcu congue massa, maximus aliquam dolor metus a leo. Phasellus ut magna in purus mollis finibus. Phasellus enim orci, vestibulum ut lorem eu, volutpat facilisis ligula.

        Nulla placerat dui vel ligula pulvinar aliquet. Cras eleifend sapien ligula, in dictum libero dignissim id. Integer sed molestie sapien, id consequat arcu. Maecenas et dictum neque. Cras eget ornare mi, nec condimentum sapien. Ut maximus urna ac turpis dapibus lacinia. Proin ac feugiat metus. Interdum et malesuada fames ac ante ipsum primis in faucibus.

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, leo a eleifend mollis, ante sapien tristique ipsum, sed luctus lectus enim id purus. Curabitur aliquet ex nec mauris dapibus lacinia. Sed pellentesque eros eget turpis aliquam, ut dictum metus commodo. Donec ultrices magna vel lorem ornare, id bibendum lectus rutrum. Sed sed porttitor orci, id efficitur nulla. Sed tempus purus in ultricies rhoncus. Mauris eget placerat metus. Vivamus malesuada erat id dictum pulvinar.

        Etiam sit amet ullamcorper velit, at vehicula neque. Duis interdum velit massa, a tristique risus sollicitudin convallis. Fusce tincidunt egestas ipsum non commodo. Nam vitae nunc a erat dignissim placerat. Mauris luctus congue ante a pulvinar. Aenean semper vitae sem a lacinia. Nullam ornare posuere nibh sed porta. Vivamus non leo ac nisl semper egestas. Suspendisse mattis, diam quis bibendum vehicula, risus quam ornare dolor, nec scelerisque ipsum tortor at dolor. Ut nunc orci, maximus eu porttitor commodo, eleifend eu tortor. Nunc tincidunt molestie lectus. Donec iaculis porta egestas. Nunc pulvinar, sapien quis elementum facilisis, leo est viverra nulla, quis ultricies sem nunc at arcu. Suspendisse vehicula tortor porta, sagittis eros vitae, fringilla diam. Suspendisse mauris ipsum, semper vel ligula viverra, ultricies venenatis ipsum.</p>

    <a name=3></a><h1>About us</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed dignissim metus. Cras eleifend a sem ac bibendum. Nam fringilla volutpat sollicitudin. Nullam non dictum metus. Aliquam erat volutpat. In vel interdum lorem. Nullam et leo pretium, congue sem suscipit, viverra nibh. Aliquam lacinia ultricies odio, et luctus eros sollicitudin at. Phasellus vitae augue feugiat, mattis augue id, elementum magna.

        Fusce vitae leo sed magna molestie facilisis. Praesent scelerisque tortor urna, a elementum tellus dignissim sed. Duis tincidunt quam dui, vel ultricies justo facilisis sit amet. Nulla molestie iaculis felis, vel pharetra mauris congue a. Integer pharetra mauris sed enim efficitur dignissim. Quisque luctus lectus ac lorem laoreet, sit amet fringilla neque iaculis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque magna quam, blandit eu maximus ac, luctus sed tortor. Proin posuere ullamcorper dui sit amet dignissim. Mauris efficitur vulputate dictum. Vivamus sagittis tincidunt magna et ultricies.

        Vivamus varius vitae urna quis varius. Mauris iaculis dignissim lectus, eu aliquet mi. Donec eleifend elementum mattis. Proin lobortis, libero eu dapibus tincidunt, diam ex blandit mi, et venenatis arcu felis sit amet dolor. Integer volutpat lectus quis venenatis malesuada. Mauris hendrerit velit ut dui aliquet venenatis. Praesent venenatis eget felis nec consectetur. Quisque consequat ante sed fringilla sodales. Quisque porta risus eu elit auctor laoreet. Sed efficitur metus erat, eget porta ex gravida eget.

        Integer vitae aliquet lorem. Maecenas eget risus tempus, pellentesque eros eu, facilisis urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris vehicula orci nisl, quis venenatis eros porta a. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent mattis et ipsum eu sagittis. Aliquam tincidunt magna id semper molestie. Integer ac tortor quis nunc hendrerit posuere ut sed nunc. Nullam porttitor libero ullamcorper finibus pellentesque. Aenean porttitor nibh ac urna accumsan porta. Vestibulum in velit tellus. Ut auctor dignissim placerat. Nullam finibus purus in ex tincidunt egestas. Curabitur rutrum ultrices enim nec commodo. Nulla scelerisque leo et lectus sollicitudin, vitae ultrices ligula porta. Morbi a eleifend sem.

        Sed tristique quam tellus. Sed sed laoreet magna. Vivamus ut interdum augue, eu venenatis quam. Duis mattis dignissim nunc sit amet mollis. Nullam in libero luctus, pellentesque augue aliquet, mollis nisl. Curabitur vitae velit id nulla malesuada pharetra vel quis ante. Morbi luctus molestie pharetra. Phasellus porttitor, arcu fermentum euismod pharetra, neque arcu congue massa, maximus aliquam dolor metus a leo. Phasellus ut magna in purus mollis finibus. Phasellus enim orci, vestibulum ut lorem eu, volutpat facilisis ligula.

        Nulla placerat dui vel ligula pulvinar aliquet. Cras eleifend sapien ligula, in dictum libero dignissim id. Integer sed molestie sapien, id consequat arcu. Maecenas et dictum neque. Cras eget ornare mi, nec condimentum sapien. Ut maximus urna ac turpis dapibus lacinia. Proin ac feugiat metus. Interdum et malesuada fames ac ante ipsum primis in faucibus.

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dapibus, leo a eleifend mollis, ante sapien tristique ipsum, sed luctus lectus enim id purus. Curabitur aliquet ex nec mauris dapibus lacinia. Sed pellentesque eros eget turpis aliquam, ut dictum metus commodo. Donec ultrices magna vel lorem ornare, id bibendum lectus rutrum. Sed sed porttitor orci, id efficitur nulla. Sed tempus purus in ultricies rhoncus. Mauris eget placerat metus. Vivamus malesuada erat id dictum pulvinar.

        Etiam sit amet ullamcorper velit, at vehicula neque. Duis interdum velit massa, a tristique risus sollicitudin convallis. Fusce tincidunt egestas ipsum non commodo. Nam vitae nunc a erat dignissim placerat. Mauris luctus congue ante a pulvinar. Aenean semper vitae sem a lacinia. Nullam ornare posuere nibh sed porta. Vivamus non leo ac nisl semper egestas. Suspendisse mattis, diam quis bibendum vehicula, risus quam ornare dolor, nec scelerisque ipsum tortor at dolor. Ut nunc orci, maximus eu porttitor commodo, eleifend eu tortor. Nunc tincidunt molestie lectus. Donec iaculis porta egestas. Nunc pulvinar, sapien quis elementum facilisis, leo est viverra nulla, quis ultricies sem nunc at arcu. Suspendisse vehicula tortor porta, sagittis eros vitae, fringilla diam. Suspendisse mauris ipsum, semper vel ligula viverra, ultricies venenatis ipsum.</p>
</div>


</body>
</html>