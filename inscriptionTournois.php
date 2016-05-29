<?php 

require './inc/header.php';
require './inc/Includes/lib_include.php';
require_once './db.php';
logged_only();


$tournois_id = $_GET['tournois_id'];
$nom = $_GET['moi'];

 

$moi = $_SESSION['auth']->username; 



$req = $pdo->prepare("INSERT INTO tournois_hs SET fk_id_tournois= ?, fk_username = ?");


$req->execute([$tournois_id,$nom]);
$_SESSION['flash']['succes']= 'Vous êtes inscrit au tournois';

header('Location: http://localhost/TFE/tournois.php');
      
 die();




        


?>