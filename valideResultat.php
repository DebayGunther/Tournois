<?php
require './inc/header.php';
require './inc/Includes/lib_include.php';
require_once './Controlleur/ControlleurDB.class.php';
$controlleurDB = new ControlleurDB();
logged_only();


$tour = $_GET['tour'];



switch ($tour){
    case 1 :
$gagnant1 = $_GET['g1'];
$gagnant2 = $_GET['g2'];
$id = $_GET['id'];

require './db.php';

$req = $pdo->prepare("UPDATE `tfe`.`match` SET `result` = ? WHERE `match`.`pk_id_tournoi` = ? and `match`.`matche` = 1 ")->execute([$gagnant1,$id]);
$req2 = $pdo->prepare("UPDATE `tfe`.`match` SET `result` = ? WHERE `match`.`pk_id_tournoi` = ? and `match`.`matche` = 2 ")->execute([$gagnant2,$id]);
$req3 = $pdo->prepare("UPDATE `tfe`.`tournois` SET `tour` = '2' WHERE `tournois`.`id_tournois` = ?; ")->execute([$id]);

$sql = "INSERT INTO `tfe`.`match` (`joueur1`, `joueur2`, `tour`, `pk_id_tournoi`, `result`,`matche`) VALUES ('$gagnant1', '$gagnant2', '2', '$id', 'aucun','3')";
$pdo->exec($sql);

$_SESSION['flash']['succes']= 'Les scores ont bien été mis a jour';

header('Location: ' . $_SERVER['HTTP_REFERER']);;break;


    case 2 :
// 
        
$gagnant = $_GET['g'];
$id = $_GET['id'];

require './db.php';

$req = $pdo->prepare("UPDATE `tfe`.`match` SET `result` = ? WHERE `match`.`pk_id_tournoi` = ? and `match`.`matche` = 3 ")->execute([$gagnant,$id]);
$req3 = $pdo->prepare("UPDATE `tfe`.`tournois` SET `tour` = '3' WHERE `tournois`.`id_tournois` = ?; ")->execute([$id]);

$req3 = $pdo->prepare("UPDATE `tfe`.`tournois` SET `nom_vainqueur` = ? WHERE `tournois`.`id_tournois` = ?; ")->execute([$gagnant,$id]);


$_SESSION['flash']['succes']= 'Les scores ont bien été mis a jour';

header('Location: ' . $_SERVER['HTTP_REFERER']);


break;
    
    
}
