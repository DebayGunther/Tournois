<?php

class DB {
   
    // CONNEXION A LA BASE DE DONNEE
    
    public $bdd;
    public function __construct() {     
         $this->bdd = new PDO('mysql:dbname=tfe;host=localhost','root','');
    }
    
    
public function getAll(){
$sql_txt ="select * from users";   
$sql = $this->bdd->query($sql_txt);
return $sql;
}


function get_palmares($user){
    
   $user = mysql_escape_string($user);
   
    $req = "SELECT a.username,b.id_tournois,b.nom_tournois,b.jeu,b.date_fin "
            . "from users a "
            . "join tournois b on (a.username = b.nom_vainqueur) "
            . "WHERE a.username = '" . $user . "'";

    $sql = $this->bdd->query($req);
    
    return $sql;
}

function get_all_tournois_dispo($jeu){
    
     $jeu = mysql_escape_string($jeu);
    
      $req = "select distinct nom_tournois,jeu,nb_joueur_max,recompense,fk_username,id_tournois
            from tournois
            where status = 0
            and jeu='".$jeu."'
            group by nom_tournois
            ";
   
    $sql = $this->bdd->query($req);
    
    return $sql;
    
    
}


function get_running_tournois($jeu){
     $jeu = mysql_escape_string($jeu);
    
      $req = "select distinct b.nom_tournois,b.nb_joueur_max,b.status,b.jeu,b.id_tournois,b.fk_username
              from tournois_hs a 
              join tournois b on ( a.fk_id_tournois = b.id_tournois) 
              and b.status = 0 OR b.status = 2 
              and jeu ='Heartstone'";
   
    $sql = $this->bdd->query($req);
    
    return $sql;
    
    
}

function get_nb_participants($id){
     $id = mysql_escape_string($id);
          $req = "select count(a.fk_username) as nb
from tournois_hs a
join tournois b on (a.fk_id_tournois = b.id_tournois)
where a.fk_id_tournois = " . $id;
   
    $sql = $this->bdd->query($req);
    
    //echo $req;
    return $sql;
    
    
}


function get_current_player($id){
    $id = mysql_escape_string($id);
          $req = "SELECT fk_username
                from tournois_hs
                where fk_id_tournois = " . $id;
   
    $sql = $this->bdd->query($req);
    
    //echo $req;
    return $sql;
    
    
}






public function get_status($id){  
    $id = mysql_escape_string($id);
$req = "SELECT status
from tournois
where id_tournois =" . $id;

$sql = $this->bdd->query($req);
 
return $sql;
 

  
}

public function getTour($id){
    $id = mysql_escape_string($id);
    $req = "Select tour from tournois where id_tournois =" . $id;
    $sql = $this->bdd->query($req);
    
    return $sql;
    
    
}

public function get_player_tour1_match1($id){
    $id = mysql_escape_string($id);
    $req = "select joueur1,joueur2,tour,result,matche from tfe.match where pk_id_tournoi = " . $id . " and tour =1" ." and matche = 1";
    $sql = $this->bdd->query($req);
    return $sql;
    
    
}

public function get_player_tour1_match2($id){
    $id = mysql_escape_string($id);
    $req = "select joueur1,joueur2,tour,result,matche from tfe.match where pk_id_tournoi = " . $id . " and tour =1"  ." and matche = 2";
    $sql = $this->bdd->query($req);
    return $sql;
    
    
}


public function get_player_tour2($id){
    $id = mysql_escape_string($id);
    $req = "select joueur1,joueur2,tour,result,matche from tfe.match where pk_id_tournoi = " . $id . " and tour =2"  ." and matche = 3";
    
    $sql = $this->bdd->query($req);
   // echo $req;
  
    return $sql;
    
    
}

public function get_gagnant($id){
    $id = mysql_escape_string($id);
      $req = "select nom_vainqueur  from tfe.tournois where id_tournois = " . $id;
    $sql = $this->bdd->query($req);
 
  
    return $sql;
    
}







public function get_stream($jeu){
    $jeu = mysql_escape_string($jeu);
   $req =  "select * from streams where jeu_stream = '" . $jeu . "'";
   
   $sql = $this->bdd->query($req);
   return $sql;
    
    
}



public function get_jeu_Stream(){
   $req =  "select distinct jeu_stream from streams";
   
   $sql = $this->bdd->query($req);
   return $sql;
    
    
}
   

public function get_user_stream($id){
     $id = mysql_escape_string($id);
    $req = "select count(id_stream) as count from streams where fk_user_id = '" . $id . "'";
      $sql = $this->bdd->query($req);
   return $sql;
    
    
}


public function get_user_stream_info($id){
    $id = mysql_escape_string($id);
    $req = "select * from streams where fk_user_id = '" . $id . "'";
      $sql = $this->bdd->query($req);
   return $sql;
    
    
}
    

    
    
}
