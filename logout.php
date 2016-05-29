<?php
include './inc/header.php';

session_start();

unset($_SESSION['auth']);

$_SESSION['flash']['success'] = "Vous êtes déconnecté";

header('Location: http://localhost/TFE/login.php');
