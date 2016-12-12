<?php


$user_id = $_GET['id'];
require './db.php';
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();



session_start();
$req = $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ? ')->execute([$user_id]);

$_SESSION['auth'] = $user;


header('Location: http://localhost/TFE/account.php');