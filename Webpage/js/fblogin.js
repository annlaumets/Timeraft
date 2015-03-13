function appPropagation() {
    "use strict";

    $.ajax({
        url: '/include/fblogin.php',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            // do whatever you want.
            // data.status: bool, true => login
            // [data.message: string]
            // [data.more: string]
        }
    });
}

function login() {
    "use strict";

    document.cookie = 'fb_token=' + FB.getAuthResponse().accessToken;
    appPropagation();
}

function logout() {
    "use strict";

    document.cookie = 'fb_token=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    appPropagation();
}

// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    "use strict";
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        console.log("Successful fb login");
        login();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        console.log("Fb login js error1");
        logout();
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        console.log("FB login js error2");
        logout();
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    "use strict";
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function () {
    "use strict";
    FB.init({
        appId: '{430038987162090}',
        cookie: true,  // enable cookies to allow the server to access
                       // the session
        xfbml: true,  // parse social plugins on this page
        version: 'v2.2' // use version 2.2
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    // // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    checkLoginState();

};

// Load the SDK asynchronously
(function (d, s, id) {
    "use strict";
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/et_EE/sdk.js#xfbml=1&appId=430038987162090&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function (response) {
        console.log('Successful login for: ' + response.name);
        document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
    });
}
