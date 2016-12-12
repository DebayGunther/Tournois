<?php 
require './inc/header.php';
require './inc/Includes/lib_include.php';
logged_only();

////////////////////////////////////////////////////////
// Je regarde si des données sont envoyées en post   //
//////////////////////////////////////////////////////

if(!empty($_POST)){
    
    
////////////////////////////////////////////////////////////////////
// Si c'est ok, je vérifie que les mots de passes soient rempis  //
// et concordent                                                 //
//////////////////////////////////////////////////////////////////
    
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mots de passe ne correspondent pas";
        header('Location: http://localhost/TFE/changepwd.php');
        
    }else{
        
/////////////////////////////////////////////////////////////////////////////
// si ils concordent, je récupére les informations et je fais ma requéte  //
// pour changer le mot de passe                                          //
//////////////////////////////////////////////////////////////////////////
        
        $user_id = $_SESSION['auth']->id;
        
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        require_once './DB/db.php';
        $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password,$user_id]);
       $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis a jour";
       header('Location: http://localhost/TFE/account.php');
    }
    
}
?>



<form action="" method="post">
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe"/>
    </div>
    
    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe"/>
    </div>
    
    <button class="btn btn-primary">Changer mon mot de passe</button>
    
</form>


