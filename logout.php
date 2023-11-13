<?php
session_start();

if (isset($_SESSION['login_user'])) {
    unset($_SESSION['login_user']);
}

if (isset($_COOKIE['login_user'])) {
    setcookie('login_user', '', 0, "/");
}

header('Location: index.php');


?>