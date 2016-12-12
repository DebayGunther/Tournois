<?php

include './inc/header.php';
require_once './db.php';
require './inc/Includes/lib_include.php';

?>


<?php 

///////////////////////////////////////////////////////////////
// Je vérifie que les données soient bien envoyées en post  //
/////////////////////////////////////////////////////////////

if(!empty($_POST)){
    
 ///////////////////////////////////////////////////////////////
// Je n'autorise que les caractére alhanumérique              //
/////////////////////////////////////////////////////////////
    
    if(empty($_POST['nameTournoi']) || !preg_match('/^[a-z0-9A-Z_]+$/',$_POST['nameTournoi'])){
        $errors['nameTournoi'] = "Le titre n'est pas valide ( Merci de retirer les espaces)";
    }else{
        
        $req = $pdo->prepare('SELECT nom_tournois  FROM tournois WHERE nom_tournois = ?');
        $req->execute([$_POST['nameTournoi']]);
       $user =  $req->fetch();
       if($user){
           $errors['nameTournoi'] = "Ce nom est déja pris";
       }
        
    }
    
    
     /////////////////////////////////////////////////////////////////////////
// Ensuite, je vérifie qu'un jeu est bien selectionné et en même temps////////
// je regarde que l'utilisateur n'a pas modifié le type de jeu             //
///////////////////////////////////////////////////////////////////////////
    
     if(empty($_POST['jeu'])){
         $errors['jeu'] = "Merci de choisir un jeu";
     }else{
        
        $req = $pdo->prepare('SELECT jeu FROM tournois WHERE jeu = ?');
        $req->execute([$_POST['jeu']]);
       $user =  $req->fetch();
       if(!$user){
           $errors['jeu'] = "Ce jeu n'est pas valide . . . mais comment t'as fais ça sérieux ?";
       }
        
    }
    
/////////////////////////////////////////////////////////////////////////
// Ensuite, je vérifie qu'un jeu est bien selectionné et en même temps////////
// je regarde que l'utilisateur n'a pas modifié le type de jeu             //
///////////////////////////////////////////////////////////////////////////
     
    if(empty($_POST['maxplayer'])){
         $errors['maxplayer'] = "Merci de choisir un nombre de joueurs max";
     }else{
        
        $req = $pdo->prepare('SELECT nb_joueur_max FROM tournois WHERE nb_joueur_max = ?');
        $req->execute([$_POST['maxplayer']]);
       $user =  $req->fetch();
       if(!$user){
           $errors['maxplayer'] = "Le nombre de joueur choisit n'est pas valide . . . mais comment t'as fais ça sérieux ?";
       }
        
    }

  ///////////////////////////////////////////////
  // Si tout est ok, alors j'envoie         //
    /////////////////////////////////////
      
     
     if(empty($errors)){

$moi = $_SESSION['auth']->username; 

$req = $pdo->prepare("INSERT INTO tournois SET nom_tournois = ?, jeu = ?, nb_joueur_max = ?,fk_username = ?");

$req->execute([$_POST['nameTournoi'],$_POST['jeu'],$_POST['maxplayer'],$moi]);
$_SESSION['flash']['succes']= 'Le tournoi a bien été créé';

header('Location: http://localhost/TFE/showTournois.php');
      
 die();

    
}
     
}


?>


<style>
    form{
        font-size: 15px;
        margin-left: 75px;  
    }
    h1{
        margin-left: 5%
    }
</style>

<h1> Créer un tournois <h1>
        
        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
                <?php                foreach ($errors as $error): ?>
                <li><?= $error;?></li>
                <?php            endforeach;?>
            </ul>
        </div>
        <?php        endif;?>

        <form action="" method="POST">
            
            <div id="formitude"> 
            <div class="form-group"> 
                <label>Nom du Tournoi (Seulement en alpha numérique)</label>
                <input style="width: 200px" type="text" name="nameTournoi" class="form-control"/>
            </div>
            
            <div class="form-group"> 
                <label>jeu</label>
                <SELECT name="jeu" size="1" selected="">
               <option disabled selected value> -- select an option -- </option>
                <OPTION>Heartstone
                </SELECT>
            </div>
                
                <div class="form-group"> 
                <label>Joueurs max</label>
                <SELECT name="maxplayer" size="1" selected="">
               <option disabled selected value> -- select an option -- </option>
                <OPTION>4
                </SELECT>
            </div>

            
            <button type="submit" class="btn btn-primary">Créer le tournoi</button>
            
            <div>
                
            
        </form>