<?php
include './inc/header.php';
///////////////////////////////////////////////////////////////////////
// je regarde si j'ai remplis les champs //
//////////////////////////////////////////////////////////////////////

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    
    require_once './DB/db.php';
    require_once './inc/Includes/lib_include.php';
 
    
    ///////////////////////////////////////////////////////////////////////
// je vais voir si l'user existe //
//////////////////////////////////////////////////////////////////////
    
    $req = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :username');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    
///////////////////////////////////////////////////////////////////////
// si il existe, je regarde son mot de passe //
//////////////////////////////////////////////////////////////////////
    
    if(password_verify($_POST['password'],$user->password))
    {
        session_start();
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Vous êtes connecté";
        header('Location: account.php');
        exit();
        
    }else{
        
    $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";
    header('Location: http://localhost/TFE/login.php');
    
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

<h1> Se connecter <h1>
        
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
                <label>Pseudo ou email</label>
                <input style="width: 200px" type="text" name="username" class="form-control"/>
            </div>
            
           
            
            <div class="form-group"> 
                <label>Mot de passe</label>
                <input style="width: 200px" type="password" name="password"  class="form-control"/>
            </div>
            

            
            <button type="submit" class="btn btn-primary">Se connecter</button>
            
            <div>
                
            
        </form>