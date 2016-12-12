<?php

include './inc/header.php';
require_once './db.php';
require './inc/Includes/lib_include.php';

?>


<?php 
$moi = $_SESSION['auth']->id;
///////////////////////////////////////////////////////////////
// Je vérifie que les données soient bien envoyées en post  //
/////////////////////////////////////////////////////////////

if(!empty($_POST)){
    
 ///////////////////////////////////////////////////////////////
// Je n'autorise que les caractére alhanumérique              //
/////////////////////////////////////////////////////////////
    
    if(empty($_POST['nameStream'])){
        $errors['nameStream'] = "Titre non valide";
    }else{
        
        $req = $pdo->prepare('SELECT adresse_stream  FROM streams WHERE adresse_stream = ?');
        $req->execute([$_POST['nameStream']]);
       $user =  $req->fetch();
       if($user){
           $errors['nameStream'] = "Ce nom est déja pris ou le stream est déja diffusé sur ce site.";
       }
        
    }
    

    
     if(empty($_POST['jeu'])){
         $errors['jeu'] = "Merci de choisir un jeu";
     }
    


  ///////////////////////////////////////////////
  // Si tout est ok, alors j'envoie         //
    /////////////////////////////////////
      
     
     if(empty($errors)){

$moi = $_SESSION['auth']->username; 

$req = $pdo->prepare("INSERT INTO streams SET adresse_stream = ?, statut_stream = 1, fk_user_id = ?,jeu_Stream = ?, nom_stream = ?");

$req->execute([$_POST['nameStream'],$moi,$_POST['jeu'],$_POST['nameStream']]);
$_SESSION['flash']['succes']= $moi;

header('Location: http://localhost/TFE/stream.php?jeu=');
      
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

<h1> Ajouter un stream <h1>
        
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
                <label>Pseudo du compte twitch a ajouter</label>
                <input style="width: 200px" type="text" name="nameStream" class="form-control"/>
            </div>
            
            <div class="form-group"> 
                <label>Nom du jeu</label>
                <input style="width: 200px" type="text" name="jeu" class="form-control"/>
            </div>
                

            </div>

            
            <button type="submit" class="btn btn-primary">Ajouter le stream</button>
            
            <div>
                
            
        </form>