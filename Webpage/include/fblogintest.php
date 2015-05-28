<?php
/**
 * Created by PhpStorm.
 * User: Ann
 * Date: 22.05.2015
 * Time: 20:25
 */

session_start();
require("db_connection.php");

// Facebook app settings
$iniArray = parse_ini_file("fbsecret.ini");

$app_id = $iniArray['FBAppId'];
$app_secret = $iniArray['FBAppSecret'];
$redirect_uri = 'http://localhost/index.php';

// Requested permissions for the app - optional.
$permissions = array(
    'email',
    'public_profile'
);

// Autoload the required files
require_once('C:\wamp\www\Webpage\lib\facebook-php-sdk-v4-4.0-dev\autoload.php');

use Facebook\FacebookRequestException;
use Facebook\FacebookSDKException;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

// Initialize the SDK.
FacebookSession::setDefaultApplication($app_id, $app_secret);

// Initialize the Facebook SDK.
FacebookSession::setDefaultApplication($app_id, $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_uri);

try {
    $session = $helper->getSessionFromRedirect();
    file_put_contents("test1.txt", "caaatchsjdyjsjhkwe");
} catch(FacebookSDKException $e) {
    file_put_contents("test1.txt", "caaatchsjdyjsjhkwe");
    $session = null;
}
//// Authorize the user.
//try {
//    if (isset($_SESSION['access_token'])) {
//        // Check if an access token has already been set.
//        $session = new FacebookSession($_SESSION['access_token']);
//    } else {
//        // Get access token from the code parameter in the URL.
//        $session = $helper->getSessionFromRedirect();
//    }
//} catch (FacebookRequestException $ex) {
//    // When Facebook returns an error.
//    print_r($ex);
//} catch (\Exception $ex) {
//    // When validation fails or other local issues.
//    print_r($ex);
//}

if ($session) {
    file_put_contents("test2.txt", "LongAssStruggle");
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

    $checkRes = $checkstmt->fetchAll();

    if (count($checkRes) != 0) {
        $logoutURL = $helper->getLogoutUrl($session, 'http://timeraft.cloudapp.net/include/logout');
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['loginUser'] = $femail;
        $_SESSION['UserID'] = $checkstmt['ID'];
        header("Location: /mainboard.php");
    } else {
        $fbstmt = $conn->prepare("CALL sp_reg_fbemail('$fname',$fuid', '$femail')");
        $logoutURL = $helper->getLogoutUrl($session, 'http://timeraft.cloudapp.net/include/logout');
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['loginUser'] = $femail;
        $_SESSION['UserID'] = $checkstmt['ID'];
        header("Location: /mainboard.php");
        }

} else {
    // Generate the login URL for Facebook authentication.
    $loginUrl = $helper->getLoginUrl($permissions);
}


