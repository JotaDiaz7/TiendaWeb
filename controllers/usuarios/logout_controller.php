<?php
session_start();

$_SESSION = array(); 

session_unset();
session_destroy();

if(isset($_COOKIE)){
    setcookie("usuario", '', time() - 3600, '/');
    setcookie("usuario", '', time() - 3600, '/', $_SERVER['HTTP_HOST']); 
}

header("Location: /");