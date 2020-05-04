<?php

//REDIRECTION PAGE ADMIN_SPACE
if (isset($_POST['admin'])) {
    header('location: ?p=admin');
}

//DETRUIRE LA SESSION
if (isset($_POST['disconnect'])) {
    unset($_SESSION['pseudo']);
    unset($_SESSION['role']);
    header('location: ./');
}

//SWITCH LANG
if (!isset($_POST['lang'])) {
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 1;
    }
} else {
    $lang = $_POST['lang'];
    setcookie('lang', $lang, time() + 60 * 60);
}
