<?php
session_start();
include './inc/header.php';
require_once './db.php';
require './inc/Includes/lib_include.php';

?>


<?php 


if(!empty($_POST)){
    
    if(empty($_POST['username']) || !preg_match('/^[a-z0-9A-Z_]+$/',$_POST['username'])){
        $errors['username'] = "Votre pseudo n'est pas valide";
    }else{
        
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
       $user =  $req->fetch();
       if($user){
           $errors['username'] = "Ce pseudo est déja pris";
       }
        
    }
     if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
         $errors['email'] = "Votre email n'est pas valide";
     }else{
        
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
       $user =  $req->fetch();
       if($user){
           $errors['email'] = "Cet email est déja utilisé pour un autre compte";
       }
        
    }
     
     if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
         $errors['password'] = "Vous devez rentrer un mot de passe valide";
     }
    
     
     
     if(empty($errors)){
    

$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?");
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$req->execute([$_POST['username'],$password,$_POST['email']]);
$user_id = $pdo->lastInsertId();

$_SESSION['flash']['succes']= 'Le compte a bien été créé';
header('Location: http://localhost/TFE/confirm.php?id='.$user_id);

exit();

    
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

<h1> S"inscrire <h1>
        
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
                <label>Pseudo</label>
                <input style="width: 200px" type="text" name="username" class="form-control"/>
            </div>
            
            <div class="form-group"> 
                <label>Email</label>
                <input style="width: 200px" type="email" name="email"  class="form-control"/>
            </div>
            
            <div class="form-group"> 
                <label>Mot de passe</label>
                <input style="width: 200px" type="password" name="password"  class="form-control"/>
            </div>
            
            <div class="form-group"> 
                <label>confirmer votre mot de passe</label>
                <input style="width: 200px" type="password" name="password_confirm"  class="form-control"/>
            </div>
            
            <button type="submit" class="btn btn-primary">M'inscrire</button>
            
            <div>
                
            
        </form>