<?php $jeu = $_GET['jeu']; ?>


 <div id="conteneur_general">
        
        <!-- contient le format tableau -->
<div class="container back_white"> 
<br>
    <section class="ac-container">
       <article class="ac-medium"> 
           <div id='stream'>
          <?php
           
           $controlleurDB->display_streams($jeu);

                  
         ?>
               </div>

    </section>
</div>
        
        
        
    </div>    
