<?php
/**
 * Completely rewritten ! By Andre.
 */

// Use some namespaces
use Facebook\FacebookSession;
use Facebook\FacebookRequest;

// Used to return json-encoded data
$obj = new StdClass();
// default status : true (success)
$obj->status = true;

//the fb token cookie is not set
if(!isset($_COOKIE['fb_ttoken'])) {
    // Logout??
    // unset all the sessions variables
    session_unset();
    $obj->status = false;
    $obj->message = 'Logout';
    // Should probably change this ??
    die(json_encode($obj));
}

//Pole kindel selles osas
session_start();

require("db_connection.php");

if (isset($_SESSION['login'])) {
    header("location: /mainboard.php");
    exit;
}

require_once('facebook/FacebookSession.php');
require_once('Facebook/RedirectLoginHelper.php');
require_once('facebook/FacebookRequest.php');
require_once('facebook/FacebookResponse.php');
require_once('facebook/FacebookSDKException.php');
require_once('facebook/FacebookRequestException.php');
require_once('facebook/FacebookOtherException.php');
require_once('facebook/FacebookAuthorizationException');

// Take very secret .ini file secret stuff
$iniFBSecret = parse_ini_file("fbsecret.ini");

FacebookSession::setDefaultApplication($iniFBSecret['FBAppId'], $iniFBSecret['FBAppSecret']);

// bind the JavaScript SDK session token with the PHP SDK
$session = new FacebookSession($_COOKIE['fb_token']);

// in case someone manually changed the cookie
// or the session expired...
try {
    $session->validate();
} catch (FacebookRequestException $ex) {
    $obj->status = false;
    $obj->message = 'Invalid facebook session';
    $obj->more = $ex->getMessage();
    die(json_encode($obj));
} catch (\Exception $ex) {
    $obj->status = false;
    $obj->message = 'Graph API error';
    $obj->more = $ex->getMessage();
    die(json_encode($obj));
}

// session ok, retrieve data
try {
    $request = new FacebookRequest($session, 'GET', '/me');
    // this means: retrieve a GraphObject and cast it as a GraphUser (as /me returns a GraphUser object)
    // $me = $request->execute()->getGraphObject(GraphUser::className());
} catch (FacebookRequestException $ex) {
    $obj->status = false;
    $obj->message = 'Facebook Request error';
    $obj->more = $ex->getMessage();
    die(json_encode($obj));
} catch (\Exception $ex) {
    $obj->status = false;
    $obj->message = 'Generic Facebook error';
    $obj->more = $ex->getMessage();
    die(json_encode($obj));
}

// setup the user object
$user = new StdClass();
$user->facebookId = $me->getId();
$user->name = $me->getName();
$user->email = $me->getProperty('email');   // some properties don't have a specific method

// insert here the object in your database (insert on key exists update, for example)
// PDO, MySQLi, MongoClient...
if (isset($user)) {
    $loginStmt = $conn->prepare("SELECT * FROM Users WHERE Email = :email");
    $loginStmt->execute(array('email'=>$user['email']));
    $result = $loginStmt->fetch(PDO::FETCH_ASSOC);
    // Vaatame, kas user sellise kasutajaga on olemas
    if($result) {
        if (count($result) > 0) {
            session_regenerate_id(true);
            $_SESSION['login'] = true;
            $_SESSION['loginUser'] = $user['email'];
            $updateLastVisited = $conn->prepare("Update Users SET Time_Last_Visited = now() WHERE Email = ".$user['email']);
            if ($redirectURL) {
                // file_put_contents('error.txt', $redirectURL, FILE_APPEND | LOCK_EX);
                header("Location:" . $redirectURL);
            } else {
                header("Location: /mainboard.php");
            }
            exit;
        } else {
            die("Failed login with facebook. Andre please fix it.");
        }
    } else {
        // Kasutaja pole registreeritud, Tee uus kasutaja :)
        $insert = $conn->prepare("CALL add_user(':name', ':pass', ':email')");
        $insert->execute(array('name'=>$user['name'], 'pass'=>$user['facebookId'], 'email'=>$user['email']));
        if ($insert) {
            session_regenerate_id(true);
            $_SESSION['login'] = true;
            $_SESSION['loginUser'] = $email;
            header("location: /mainboard.php");
        } else {
            // Better error handling here ?
            die("Signup error, Andre viga");
        }
    }
}

$obj->message = 'Logged in';
echo json_encode($obj);