<?php 

if(session_status() == PHP_SESSION_NONE){
session_start();
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TFE - Site de tournois et de streaming</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Include des fichiers CSS bootstrap de la nav bar -->
        <link rel="stylesheet" href="inc/Includes/css/bootstrap.min.css">
        <link rel="stylesheet" href="inc/Includes/css/style.css">
        <link rel="stylesheet" href="inc/Includes/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="inc/Includes/css/main.css">
        <link rel="stylesheet" href="inc/Includes/css/main_header.css">
        <link rel="stylesheet" href="inc/Includes/css/main_footer.css">
        <!-- Include des fichiers Jquerry pour les graphs -->
        <script src="inc/Includes/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="inc/Includes/js/jQuerry/jQuerry.min.js"></script>

        
        
        
        
        
        
        
    </head>
    
    
    <body>
    
        <nav id="nav" id="section_menu" name="test" class="navbar-default" style="background-color: #3498db">     
    

      <div id="titre">TFE - Site de tournois et de streaming</div>
<ul>
<li><a href="index.php">Accueil</a></li>




<?php if(isset($_SESSION['auth'])): ?>

<li><a href="tournois.php">Tournois</a></li>
<li><a href="stream.php?jeu=">Streaming</a></li>
<li><a href="account.php">Profil</a></li>
<li><a href="logout.php">Se déconnecter</a></li>

<?php else: ?>

<li><a href="register.php">S'enregistrer</a></li>
<li><a href="http://localhost/TFE/login.php">Se connecter</a></li>

<?php endif; ?>

</ul>
    
</nav>
         

<br>



<?php if(isset($_SESSION['flash'])): ?>
    <?php foreach ($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?= $type; ?>">
            <?= $message; ?>
        </div>
    <?php endforeach;?>
<?php unset($_SESSION['flash']); ?>

<?php endif; ?>
