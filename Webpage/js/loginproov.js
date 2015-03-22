window.fbAsyncInit = function() {
    FB.init({
        appId      : '430038987162090', // replace your app id here
        channelUrl : 'localhost/index.php',
        status     : true,
        cookie     : true,
        xfbml      : true
    });

    FB.Event.subscribe('auth.authResponseChange', function(response) {
        // Here we specify what we do with the response anytime this event occurs.
        if (response.status === 'connected') {
            saveuserdetail();
        } else if (response.status === 'not_authorized') {
            // vast vale
            die("Not_authorized");
        } else {
            // vast vale
            die("Logged out");
        }
    });
};

function saveuserdetail() {
    FB.api('/me?fields=first_name,email', function(response) {
        var jdata = JSON.stringify(response);
        $.ajax({
            type: "POST",
            url: "/include/login-callback.php",
            data: {
                data: jdata
            },
            success: function(msg){
                console.log("Pärast successi.");
                console.log(msg);
                window.location.replace(msg);

            }
        });
    })
}

(function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));