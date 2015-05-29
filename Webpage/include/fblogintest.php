<?php
/**
 * Created by PhpStorm.
 * User: Ann, Andre, Viktoria, raamatukogu, longasstoken, arigato yatta
 * Date: 22.05.2015
 * Time: 20:25
 */

session_start();
require("db_connection.php");

// Autoload the required files
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/facebook-php-sdk-v4-4.0-dev/autoload.php');

use Facebook\FacebookSDKException;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;

// Facebook app settings
$iniArray = parse_ini_file("fbsecret.ini");

$app_id = $iniArray['FBAppId'];
$app_secret = $iniArray['FBAppSecret'];
$redirect_uri = 'http://timeraft.cloudapp.net/';

// Requested permissions for the app - optional.
$permissions = array(
    'email',
    'public_profile'
);

// Initialize the Facebook SDK.
FacebookSession::setDefaultApplication($app_id, $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_uri);

try {
    $session = $helper->getSessionFromRedirect();
} catch(FacebookSDKException $e) {
    $session = null;
}

if ($session) {
    $accessToken = $session->getAccessToken();
    // Exchange the short-lived token for a long-lived token.
    $longLivedAccessToken = $accessToken->extend();
    $session = new FacebookSession($longLivedAccessToken);

    $request = new FacebookRequest($session, 'GET', '/me');
    $userData = $request->execute()
        ->getGraphObject()
        ->asArray();

    $fuid = $userData["id"];
    $fname = $userData["first_name"];
    $femail = $userData["email"];

    $checkstmt = $conn->prepare("SELECT ID FROM Users WHERE facebook_uid = :fuid");
    $checkstmt->execute(array('fuid' => $fuid));

    $checkRes = $checkstmt->fetch(PDO::FETCH_ASSOC);

    if (count($checkRes) != 0) {
        $logoutUrl = $helper->getLogoutUrl($session, 'http://timeraft.cloudapp.net');
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['loginUser'] = $femail;
        $_SESSION['UserID'] = $checkRes['ID'];
        $_SESSION['logOut'] = $logoutUrl;
        header("Refresh: 0; /mainboard.php");
    } else {
        $fbstmt = $conn->prepare("CALL sp_reg_fbemail('$fname','$fuid', '$femail')");
        $fbstmt->execute();
        $checkstmt = $conn->prepare("SELECT ID FROM Users WHERE facebook_uid = :fuid");
        $checkstmt->execute(array('fuid' => $fuid));

        $checkRes = $checkstmt->fetch(PDO::FETCH_ASSOC);

        $logoutUrl = $helper->getLogoutUrl($session, 'http://timeraft.cloudapp.net');
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['loginUser'] = $femail;
        $_SESSION['UserID'] = $checkRes['ID'];
        $_SESSION['logOut'] = $logoutUrl;
        header("Refresh: 0; /mainboard.php");
    }

} else {
    // Generate the login URL for Facebook authentication.
    $loginUrl = $helper->getLoginUrl($permissions);
}