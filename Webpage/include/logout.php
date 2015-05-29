<?php

session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/facebook-php-sdk-v4-4.0-dev/autoload.php');

if (isset($_SESSION['logOut'])) {
    session_destroy();
    session_regenerate_id(true);
    header('Location: ' . $_SESSION['logOut']);

}else if ((session_destroy())) {
    session_regenerate_id(true);
    header("Location: /");
}