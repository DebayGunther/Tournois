<?php 
require './inc/header.php';
require './inc/Includes/lib_include.php';

logged_only();

?>

<style>
    td{
        border: ridge;
        text-align: center;
    }
    h1{
        float: left;
    }
    
    
</style>
<div class="container back_white"> 
<br>
    <section class="ac-container">
       <article class="ac-medium"> 
           <h1>Tournois disponible</h1>
           <a href="http://localhost/TFE/createTournois.php"> <input type="button" value="Créer un tournoi" style="margin-left: 70px;"></a> 
         
           
           <div id="information" class="projet">
           
            
               
               <table>
                   <tr>
                       <td style="border: ridge">Nom tournoi</td>
                       <td>Propriétaire du tournoi</td>
                       <td>Jeu</td>
                       <td>Nombre participant</td>
                       <td>Nombre participants max</td>
                       <td>Details</td>
                   </tr>
                   
                   <?php
                   include_once './Controlleur/ControlleurDB.class.php';
                   $controlleurDB = new ControlleurDB;
                   
                   $controlleurDB->get_all_tournois_dispo('Heartstone');
                   
                   ?>
                   
               </table>

           
          


           </div>
           
      
    </section>
</div>



