<?php 
require './inc/header.php';
require './inc/Includes/lib_include.php';
require_once './Controlleur/ControlleurDB.class.php';
$controlleurDB = new ControlleurDB();
logged_only();

$tournois_id = $_GET['id'];
$nb_participant = $_GET['nb_participants'];
$nb_max = $_GET['nb_max'];
$proprietaire = $_GET['propri'];
 

$moi = $_SESSION['auth']->username; 


$status = $controlleurDB->get_just_status($tournois_id);


        
?>

<style>
    #message{
        background-color: red;
        color : white;
        height : 30px;
        width : 250px;
    }
    #information{
       display: inline-block;
       float: left;
    }
        #test{
        display: inline-block;
        margin-left: 75px;
        background-color: #bdc3c7;
        border-radius: 10px;     
    }
    #bout{
        margin-left: -75px
    }
    #tree{
  display:table;
  width:60%;
  vertical-align:middle;
  background-color: #1abc9c;
  border-radius: 15px;
  padding: 25px;
}
.level{
  display:table-cell;
  width:33%;
  vertical-align:middle;
}
</style>


<div class="container back_white"> 
<br>
    <section class="ac-container">
       <article class="ac-medium"> 

          
           
           <div id="information" class="projet">
               Propriétaire et arbitre :<br> <div style="color: red;font-size: 25px;"> <?php echo $proprietaire; ?> </div><br>
            Nombre de participants max : <?php echo $nb_max; ?><br>
            Nombre de joueur actuel : <?php echo $nb_participant; ?><br><br>
            
            Joueurs déja inscrits : <br>
            <?php 
                  
$dbClass = new DB();  
$tab1 = $dbClass->get_current_player($tournois_id);
    while ($donnees = $tab1->fetch()){
        echo $donnees['fk_username'];
        echo "<br>";  
    }
    
$joueur[] ="";
$tab2 = $dbClass->get_current_player($tournois_id);

    while ($donnees2 = $tab2->fetch()){
        $joueur[] = $donnees2['fk_username']; 
    }          
if($nb_max > $nb_participant && !in_array($moi, $joueur) ){
    echo '<br><a id="bout" href="http://localhost/TFE/inscriptionTournois.php?tournois_id='.$tournois_id.'&moi='. $moi .'"> <input type="button" value="s\'inscrire" style="margin-left: 70px;"></a>';                                     
}else{    

    if($nb_max != $nb_participant){
    echo '<br><br><div id="message";>Vous participez déja a ce tournoi !</div>';   
    }  
    
    
    if($nb_max == $nb_participant && $status == 0){
    echo '<br><br><div style="color:green;">Le tournoi est prêt a être lancé !</div>';
    
    if($moi == $proprietaire && $status == 0){
        
        echo '<div>  <a href="http://localhost/TFE/arbreTournoi.php?id='.$tournois_id.'&propri='.$proprietaire .'"> <input type="button" value="lancer tournoi" style="margin-left: -100px;"></a> </div> ';
        
    }
    if($status == 2){
        echo $status;
    }
    
    }  
  
}

?>
</div>
           
             
 <div id="test" class="projet"  >
   
     <h1>Détail du tournoi</h1>
     <p>
         Les tournois heartstone se font en BO1 jusqu'en final.<br>
         La final se joue en BO3. (2 manches gagnantes)<br>
         Lorsque votre match est terminé, merci de contacter un administrateur <br>
         Et lui envoyer un preuve de votre victoire<br>
         Un screenshot suffit<br>
         Une fois votre match terminé, merci d'attendre que votre prochain adversaire soit prêt.
     </p>   
</div>
           
           
           
           <?php                        
           $id = $tournois_id;
           $controlleurDB->get_status($id);
           
 
           ?>



              
