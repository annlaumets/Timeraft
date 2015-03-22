<?php

use Facebook\FacebookRequest;

include 'lib2/src/Facebook/autoload.php';

require_once('lib/facebook/FacebookSession.php');
require_once('lib/Facebook/FacebookRedirectLoginHelper.php');
require_once('lib/facebook/FacebookRequest.php');
require_once('lib/facebook/FacebookResponse.php');
require_once('lib/facebook/FacebookSDKException.php');
require_once('lib/facebook/FacebookRequestException.php');
require_once('lib/facebook/FacebookOtherException.php');
require_once('lib/facebook/FacebookAuthorizationException.php');

session_start();

require("db_connection.php");


if(!empty($_POST['data'])) {
    // Define the data we are going to use here.
    $json = $_POST['data'];
    $array = json_decode($json, true); //tagastab jsoni array'na
    $name = $array['first_name'];
    $email = $array['email'];
    $fbid = $array['id'];
    $file = "testing.txt";
    //Let's do something interesting now
    $fbLogst = $conn->prepare("SELECT * FROM Users WHERE facebook_uid = :facebookid");
    $fbLogst->execute(array('facebookid' => $fbid));
    $result = $fbLogst->fetch(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        // If not empty -> Login
        file_put_contents($file, "Successful login by: ".$name, FILE_APPEND);
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['loginUser'] = $email;
        $updateLastVisited = $conn->prepare("Update Users SET Time_Last_Visited = now() WHERE facebook_uid = " . $fbid);
        echo "Success";

    } else {
        // Empty -> Register
        // Kutsub add_user meetodi, bindparam annab 3 parameetrit - name, pass, email
        $insert = $conn->prepare("CALL sp_reg_fbemail('$name', '$fbid', '$email')");
        $insert->execute();
        if ($insert) {
            session_regenerate_id(true);
            $_SESSION['login'] = true;
            $_SESSION['loginUser'] = $email;
            header("location: /mainboard.php");
        } else {
            // Better error handling here ?
            die("Signup error, Andre viga");
        }
        echo 'success';
    }
}
else {
    die("Something went wrong.");
}