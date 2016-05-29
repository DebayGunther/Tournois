<?php

include './inc/header.php';
require_once './db.php';
require './inc/Includes/lib_include.php';
require './Controlleur/ControlleurDB.class.php';
$id =  $_GET['id'];
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

require_once './DB/db.php';

        $req = $pdo->prepare('UPDATE streams SET adresse_stream = ?, jeu_stream = ?, nom_stream = ? WHERE fk_user_id = ?');
        $req->execute([$_POST['nameStream'],$_POST['jeu'],$_POST['nameStream'],$id]);
       $_SESSION['flash']['success'] = "Informations mis a joue";
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

<h1> modifier information de votre stream <h1>
        
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
                <label place>Pseudo du compte twitch a ajouter</label>
                
                <?php
                $controlleurDB = new ControlleurDB();
                $test = $controlleurDB->get_stream_info($id);
               echo ' <input style="width: 200px" type="text" name="nameStream" class="form-control" value="' . $test['adresse_stream'] .'"/>';
                ?>
                
            </div>
            
            <div class="form-group"> 
                <label>Nom du jeu</label>
                 <?php
                 $controlleurDB = new ControlleurDB();
                 $test = $controlleurDB->get_stream_info($id);
               echo ' <input style="width: 200px" type="text" name="jeu" class="form-control" value="' . $test['jeu_stream'] .'"/>';
                ?>
            </div>
                

            </div>

            
            <button type="submit" class="btn btn-primary">modifier</button>
            
            <div>
                
            
        </form>