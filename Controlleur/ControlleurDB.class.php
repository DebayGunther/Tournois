<?php

include_once './DB/DB.class.php';

class ControlleurDB  {

   

public function get_all_palmares($user){
$dbClass = new DB();    
$tab1 = $dbClass->get_palmares($user);

$res = $tab1->fetchAll();

if(count($res)== 0)
{
     echo '<div id="" class="projet">';
     echo 'Votre palmarés est vide';
     echo '<br><br><br><br><br><br>';
     echo '</div>';
    
}else {
    
        foreach ($res as $ligne){
            echo '<div id="palmares" class="projet">';
            echo ' ID du tounois : ' . $ligne['id_tournois'] . '<br>';
            echo ' Nom du tournoi : ' . $ligne['nom_tournois'] . '<br>';
            echo ' Jeu : ' . $ligne['jeu']  . '<br>';
            echo ' Place : 1er place  <br>';
            echo ' date : ' . $ligne['date_fin'] . '  <br>';
            echo ' <img src="images/trophe_1er_place.jpg"/>';
            echo '</div>';  
        }
   
    }
         
}


public function get_all_tournois_dispo($jeu){

 ///////////////////////////////////////////////////////////////
// VARIABLES                                                 //
//////////////////////////////////////////////////////////////    
$nb="";

 ///////////////////////////////////////////////////////////////
// je récupére la liste des tournois voulu                                              //
////////////////////////////////////////////////////////////// 

$dbClass = new DB();    
$tab1 = $dbClass->get_all_tournois_dispo($jeu);


 ///////////////////////////////////////////////////////////////
// je boucle simplement sur le nombre de tournois                                                //
////////////////////////////////////////////////////////////// 
while ($donnees = $tab1->fetch()){
    
        $tab2 = $dbClass->get_nb_participants($donnees['id_tournois']);
        while ($donnees2 = $tab2->fetch()){
         $nb = $donnees2['nb'];
        }
 ///////////////////////////////////////////////////////////////
// Et enfin je crée un tableau                                                //
////////////////////////////////////////////////////////////// 
    if($donnees['nb_joueur_max'] > $nb)
     {
         echo  '<tr>';
         echo  '<td>' . $donnees['nom_tournois'] . '</td>';
         echo '<td>' . $donnees['fk_username'] . '</td>';
         echo  '<td>' . $donnees['jeu'] . '</td>';
         echo  '<td>' . $nb . '</td>';
         echo '<td>' . $donnees['nb_joueur_max'] . '</td>';
         echo  '<td>' .  '<a href="http://localhost/TFE/detailTournois.php?id='.$donnees['id_tournois'] .'&nb_participants=' 
                 . $nb . '&nb_max=' . $donnees['nb_joueur_max'].'&propri='.$donnees['fk_username'] .  '"/> Voir détail';
         echo ' </tr>';
         

     }
    }
                  
}    
       

public function get_running_tournois($jeu){

 $nb="";

$dbClass = new DB();    
$tab1 = $dbClass->get_running_tournois($jeu);


while ($donnees = $tab1->fetch()){
    
        $tab2 = $dbClass->get_nb_participants($donnees['id_tournois']);
        while ($donnees2 = $tab2->fetch()){
         $nb = $donnees2['nb'];
        }

    if($donnees['nb_joueur_max'] == $nb)
    {
         echo  '<tr>';
         echo  '<td>' . $donnees['nom_tournois'] . '</td>';
          echo '<td>' . $donnees['fk_username'] . '</td>';
         echo  '<td>' . $donnees['jeu'] . '</td>';
         echo  '<td>' . $nb . '</td>';
         echo '<td>' . $donnees['nb_joueur_max'] . '</td>';
         echo  '<td>' .  '<a href="http://localhost/TFE/detailTournois.php?id='.$donnees['id_tournois'] .'&nb_participants=' . $nb . '&nb_max=' . $donnees['nb_joueur_max'] .'&propri='.$donnees['fk_username'] .  '"/> Voir détail';
         echo ' </tr>';
         

}
}                   
} 


public function get_current_player($id){
$dbClass = new DB();    
$tab1 = $dbClass->get_current_player($id);


while ($donnees = $tab1->fetch()){
  
    echo $donnees['fk_username'];
    echo "<br>";
}   
    
}


public function get_just_status($id){
    $dbClass = new DB();
    $tab1 = $dbClass->get_status($id);


while ($donnees = $tab1->fetch()){
    return  $donnees['status'];
}
    
}




public function get_status($id){
    $dbClass = new DB();
    $tab1 = $dbClass->get_status($id);


while ($donnees = $tab1->fetch()){
    $status = $donnees['status'];
}

if($status == 2){
   $this->activeTree($id);
  
}else{
    echo 'tournoi pas commencé';
} 
}

public function getTour($id){
    $dbClass = new DB();
    $tab = $dbClass->getTour($id);
    
    while ($donnees = $tab->fetch()){
    $tour = $donnees['tour'];
}
return $tour;
  
}

public function activeTree($id){
    echo 'tournoi commencé <br><br>';
    
   $tour = $this->getTour($id);
    
   switch($tour){
       case 1 : $this->afficherTour1($id,1);break;
       case 2 : $this->afficherTour2($id,2);break;
       case 3 : $this->afficherTour3($id,3);break;   
   }
      
}


public function afficherTour1($id,$tour){  
    $moi = $_SESSION['auth']->username; 
    $dbClass = new DB();
    $tab = $dbClass->get_player_tour1_match1($id,$tour);
// Ici je trie les participants pour pouvoir créer les matchs en base de donnée    
        while ($donnees = $tab->fetch()){
            $joueur1 = $donnees['joueur1'];
            $joueur2 = $donnees['joueur2'];
}

    $tab2 = $dbClass->get_player_tour1_match2($id,$tour);
    
        while ($donnees = $tab2->fetch()){
            $joueur3 = $donnees['joueur1'];
            $joueur4 = $donnees['joueur2'];
}// Je crée l'affichage de l'arbre de tournoi
        echo '<br><br><br>
<div id="tree">
    <div class="level">
        <div class="item">      
<form method="POST">
    <input type="radio" name="match1" value="'.$joueur1.'"/>' . $joueur1 .' <br> ------------vs---------- <br>
    <input type="radio" name="match1" value="'.$joueur2.'"/>'. $joueur2 .' <br><br>
        
    <input type="radio" name="match2" value="'.$joueur3.'"/>' . $joueur3 .' <br> ------------vs---------- <br>
    <input type="radio" name="match2" value="'.$joueur4.'"/>'. $joueur4 .' <br><br>';
        
   if($moi == $_GET['propri'] ){
        echo '<input type="submit" value="Enregistrer résultat"/> ';
   }else{
       echo "<p style='color:green;'>En attente des résultats";
   }
echo '</form>
       </div>
    </div>
</div>';
    // Enfin je 
if(!empty($_POST)){

$gagnant1 = $_POST['match1'];
$gagnant2 = $_POST['match2'];  
header('Location: http://localhost/TFE/valideResultat.php?g1=' . $gagnant1 . '&g2=' . $gagnant2 . '&id=' . $id . '&tour=1');
}else{
    echo "<p style='color:green;'>En attente des résultats";
    $_SESSION['flash']['danger']= '<div style="color:red;">Aucun changement effectué ( Vous n\'avez désigné aucun vainqueur)</div>';
}    
  
}


public function afficherTour2($id,$tour){  
    $moi = $_SESSION['auth']->username;  
    $dbClass = new DB();
    
        $tab = $dbClass->get_player_tour1_match1($id);
    
        while ($donnees = $tab->fetch()){
            $joueur1 = $donnees['joueur1'];
            $joueur2 = $donnees['joueur2'];
}

    $tab2 = $dbClass->get_player_tour1_match2($id);
    
        while ($donnees = $tab2->fetch()){
            $joueur3 = $donnees['joueur1'];
            $joueur4 = $donnees['joueur2'];
}

    $tab3 = $dbClass->get_player_tour2($id);
    
        while ($donnees = $tab3->fetch()){
            $joueur5 = $donnees['joueur1'];
            $joueur6 = $donnees['joueur2'];
}
    
        echo '<br><br><br>
            
<div id="tree">
    <div class="level">
        <div class="item">
            <p>' . $joueur1 . '<br> ------vs----- <br> ' . $joueur2 .'</p> 
            <p>' . $joueur3 . '<br> ------vs----- <br> ' . $joueur4 .'</p> 
       </div>
    </div>
      <div class="level">
        <div class="item">
        <form method="POST">
          <input type="radio" name="match1" value="'.$joueur5.'"/>' . $joueur5 .' <br> ------vs----- <br>
         <input type="radio" name="match1" value="'.$joueur6.'"/>'. $joueur6 .' <br><br>';
                
               if($moi == $_GET['propri'] ){
        echo '<input type="submit" value="Enregistrer résultat"/> ';
   }else{
       echo "<p style='color:green;'>En attente des résultats";
   }
echo '
</form>
        </div>
    </div>
</div>

';
    
if(!empty($_POST)){
$gagnant = $_POST['match1'];
header('Location: http://localhost/TFE/valideResultat.php?g=' . $gagnant  . '&id=' . $id ."&tour=2");
}else{
    echo "<p style='color:green;'>En attente des résultats";
    $_SESSION['flash']['danger']= '<div style="color:red;">Aucun changement effectué ( Vous n\'avez désigné aucun vainqueur)</div>';
}
}



public function afficherTour3($id,$tour){  
    $moi = $_SESSION['auth']->username;  
    $dbClass = new DB();
    
        $tab = $dbClass->get_player_tour1_match1($id);
    
        while ($donnees = $tab->fetch()){
            $joueur1 = $donnees['joueur1'];
            $joueur2 = $donnees['joueur2'];
}

    $tab2 = $dbClass->get_player_tour1_match2($id);
    
        while ($donnees = $tab2->fetch()){
            $joueur3 = $donnees['joueur1'];
            $joueur4 = $donnees['joueur2'];
}

    $tab3 = $dbClass->get_player_tour2($id);
    
        while ($donnees = $tab3->fetch()){
            $joueur5 = $donnees['joueur1'];
            $joueur6 = $donnees['joueur2'];
}

$tab4 = $dbClass->get_gagnant($id);
        while ($donnees = $tab4->fetch()){
            $gagnant = $donnees['nom_vainqueur'];
}
    
        echo '
            
<div id="tree">
    <div class="level">
        <div class="item">
            <p>' . $joueur1 . '<br> ------vs----- <br> ' . $joueur2 .'</p> 
            <p>' . $joueur3 . '<br> ------vs----- <br> ' . $joueur4 .'</p> 
       </div>
    </div>
      <div class="level">
        <div class="item">
         <p>' . $joueur5 . '<br> ------vs----- <br> ' . $joueur6 .'</p>

        </div>
    </div>
    <div class="level">
        <div class="item">
          <p> gagnant : ' . $gagnant . '</p> 
        </div>
     </div>
</div>

';
   
        
                       if($moi == $_GET['propri'] ){
         echo '<br><a id="bout" href="http://localhost/TFE/terminerTournois.php?id='.$id.'"> <input type="button" value="Terminer le tournoi" style="margin-left: 70px;"></a>';
  
   }else{
       echo "<p style='color:green;'>En attente des résultats";
   }
        
        

}



public function display_streams($jeu){
      $dbClass = new DB();
      $tab = $dbClass->get_stream($jeu);
      
      
           while ($donnees = $tab->fetch()){
             
               $adresse = $donnees['adresse_stream'];
               $titre = $donnees['nom_stream'];
               
   
           echo '
           <iframe src="https://player.twitch.tv/?channel=' . $adresse . '&autoplay=false" frameborder="0" scrolling="no" height="250" width="300" autoplay="false" style="display: inline-block;"></iframe>
            ';
}
 
}


public function get_jeux(){
          $dbClass = new DB();
          $tab = $dbClass->get_jeu_Stream();
          
                while ($donnees = $tab->fetch()){
                    echo "<option>" . $donnees['jeu_stream'] . "</option>";
                    

                }
    
    
}

public function get_player_stream($id){
     $dbClass = new DB();
          $tab = $dbClass->get_user_stream($id);
          
                while ($donnees = $tab->fetch()){
                    
                    if($donnees['count'] > 0){
                      
                     return 1;
                      
                        
                    }  else {
                    return 0;    
                    }
                    

                }
    
}



public function get_stream_info($id){
     $dbClass = new DB();
          $tab = $dbClass->get_user_stream_info($id);
          
                while ($donnees = $tab->fetch()){
                    
                    return $donnees;
                    
                    
                    
                    

                }
    
}


        
   
   





}
    
    
    
    
    

