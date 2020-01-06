<?php
if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION['login_user']) || !isset($_SESSION['loggedin']) || $_SESSION['loggedin']!='yep'){
    ob_start();
        header("HTTP/1.0 405 Method Not Allowed");
    ob_flush();
    die('HTTP/1.0 405 Method Not Allowed');
}

?>
