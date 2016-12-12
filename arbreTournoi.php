<?php 
require './inc/header.php';
require './inc/Includes/lib_include.php';
require_once './Controlleur/ControlleurDB.class.php';
$controlleurDB = new ControlleurDB();
logged_only();

$tournois_id = $_GET['id'];




require './db.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Je commence par changer l'etat du tournoi pour qu'il soit en commencé
/////////////////////////////////////////////////////////////////////////////
$req = $pdo->prepare('UPDATE tournois SET status = 2, tour = 1 WHERE id_tournois = ? ')->execute([$tournois_id]);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// J'me sert d'un array pour stocker mes participants et apres les faire s'affronter
/////////////////////////////////////////////////////////////////////////////
$dbClass = new DB();       
$joueur = array();

$tab = $dbClass->get_current_player($tournois_id);
$i =0;
    while ($donnees = $tab->fetch()){
       
        
         $joueur[$i]= $donnees['fk_username'];
         $i++;        
    }  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// a faire : créer une boucle pour que ca se fasse tour seul, quand y aura bcp + de participants
/////////////////////////////////////////////////////////////////////////////
    shuffle($joueur);
    $joueur_1 = $joueur[0];
    $joueur_2 = $joueur[1];
    $joueur_3 = $joueur[2];
    $joueur_4 = $joueur[3];
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Je crée les matchs en DB, pareil, une boucle c'est cool
/////////////////////////////////////////////////////////////////////////////
    
$sql = "INSERT INTO `tfe`.`match` (`joueur1`, `joueur2`, `tour`, `pk_id_tournoi`, `result`,`matche`) VALUES ('$joueur_1', '$joueur_2', '1', '$tournois_id', 'aucun','1')";
$pdo->exec($sql);

$sql2 = "INSERT INTO `tfe`.`match` (`joueur1`, `joueur2`, `tour`, `pk_id_tournoi`, `result`,`matche`) VALUES ('$joueur_3', '$joueur_4', '1', '$tournois_id', 'aucun','2')";
$pdo->exec($sql2);

$_SESSION['flash']['succes']= 'Le tournoi a bien été créé';


header('Location: ' . $_SERVER['HTTP_REFERER']);