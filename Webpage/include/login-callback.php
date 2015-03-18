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

//file_put_contents('error.txt', $_POST, FILE_APPEND | LOCK_EX);


if(!empty($_POST['data'])) {
    $json = $_POST['data'];
    $array = json_decode($json, true); //tagastab jsoni array'na
    $nimi = $array['first_name'];
    $email = $array['email'];
    echo 'success';
}
else {
    die("Something went wrong.");
}