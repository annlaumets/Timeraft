<?php
/**
 * Created by PhpStorm.
 * User: Ann
 * Date: 01.03.2015
 * Time: 22:55
 */

session_start();

if (!empty($_SESSION)) {
    header("Location: home.php");
}

require_once("db_connection.php");

# require library
require("facebook.php");

# Creating the facebook object
$facebook = new Facebook(array(
    'appId' => '426437317522257',
    'secret' => '92812397f3e7215d8a9b4d5272397f59',
    'cookie' => true
));

# session active, get user id (getUser()) and user info (api->('/me'))
try {
    $uid = $facebook->getUser();
    $fb_access_token=$session['access_token'];
    $url = $facebook->getLoginUrl(array(
        'req_perms' => 'email,status_update,publish_stream'
    ));
    $user = $facebook->api('/me');
    $param = array(
        'method' => 'users.getInfo',
        'uids' => uid,
        'fields' => 'pic_big'
    );
    $users_getinfo = $facebook->api($param);
} catch (Exception $e) {

}

if (!empty($user)) {
    # active session, check if already registered the user
    $query = mysql_query("SELECT * FROM users WHERE email = ". $user['email']);
    $result = mysql_fetch_array($query);

    if (empty($result)) {
    $query = mysql_query("CALL add_user('{$user['first_name']}', '$pass', '{$user['email']}')");
    $query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());
    $result = mysql_fetch_array($query);
    }

    // variables in the session
    $_SESSION['id'] = $result['id'];
    $_SESSION['oauth_uid'] = $result['oauth_uid'];
    $_SESSION['oauth_provider'] = $result['oauth_provider'];
    $_SESSION['username'] = $result['username'];}
else {
    # if error, kill the script
    die("There was an error.");
}