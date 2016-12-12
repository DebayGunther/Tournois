<?php 
require './inc/header.php';
require './inc/Includes/lib_include.php';

logged_only();

?>



<div class="container back_white"> 
<br>
    <section class="ac-container">
       <article class="ac-medium"> 

           <h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
           
           <div id="information" class="projet">
           
               <a href="http://localhost/TFE/showTournois.php"> <input type="button" value="Afficher les tournois disponibles" style="margin-left: 70px;"></a>  
               
               <a href="http://localhost/TFE/showRunningTournois.php"> <input type="button" value="Afficher les tournois en cours" style="margin-left: 70px;"></a>
               <br><br>
               
               <a href="http://localhost/TFE/createTournois.php"> <input type="button" value="Créer un tournoi" style="margin-left: 70px;"></a>  
           
          


           </div>
           
      
    </section>
</div>



