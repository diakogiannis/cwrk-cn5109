<?php
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION['login_user'])){
    unset($_SESSION['login_user']);
}
if(isset($_SESSION['loggedin'])){
    unset($_SESSION['loggedin']);
}
if(isset($_SESSION['role'])){
    unset($_SESSION['role']);
}

$_SESSION = [];
session_destroy();

header("Location: ../../site/index.php");

?>