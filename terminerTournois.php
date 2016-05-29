<?php

require './inc/header.php';
require './inc/Includes/lib_include.php';
require_once './Controlleur/ControlleurDB.class.php';
$controlleurDB = new ControlleurDB();
logged_only();

$id = $_GET['id'];

require './db.php';
$req3 = $pdo->prepare("UPDATE `tfe`.`tournois` SET `status` = 1 WHERE `tournois`.`id_tournois` = ?; ")->execute([$id]);



$_SESSION['flash']['succes']= 'Le tournoi a été cloturé';

  header('Location: http://localhost/TFE/showTournois.php');


die();
    