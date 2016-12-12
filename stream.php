<?php
ini_set('display_errors', 1);
require './inc/header.php';
require './inc/Includes/lib_include.php';
require_once './Controlleur/ControlleurDB.class.php';
$controlleurDB = new ControlleurDB();
$moi = $_SESSION['auth']->username;


logged_only();


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Sert a  récupérer le nom de mes variables pour les utiliser ici et dans mes fichiers de fonctions               //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_POST)){
$ajax_mode = $_GET['ajax_mode'];
$jeu = $_GET['jeu'];


if (is_string($ajax_mode) && $ajax_mode) { 
	switch ($ajax_mode) {
		case 'select_jeu' :
                       $tab_ajax = array();
			$tab['jeu'] = $controlleurDB->get_jeux();
			echo json_encode($tab);
			exit();   
  }
}
}

?>


<html>
    <head>
        <script  type="text/javascript" src="./inc/Includes/js/jQuerry/jQuerry.min.js"></script> 
        <link rel="stylesheet" href="./inc/Includes/css/filtre.css"/>
    </head>
    <body>
        
        <style>
            iframe{
              display: inline-block; 
              
            }
            #stream{
                display: inline-block;
            }
            
        </style>



<section class="wrapper style1">
    <div class="container">
        <article>
            <header>
                <h2>Stream</h2>
                <p>Vous avez ici la possibilité de regarder les streams des autres joueur ou de rajouter le vôtre.</p><br>
              
               <?php $test = $controlleurDB->get_player_stream($moi) ;
               
               if($test == 1){
                   echo ' <a href="http://localhost/TFE/modifStream.php?id=' . $moi . '"> <input type="button" value="modifier l\'adresse de votre stream" style="margin-left: -75px; "></a> ';
               }else{
                   echo ' <a href="http://localhost/TFE/addStream.php?id=' . $moi . '"> <input type="button" value="Ajouter votre stream" style="margin-left: -70px;"></a> ';
               }
               
               
                 ?>
                
                
                
              <?php ?>
              <?php ?>
            </header>
                
                
</section>
        


 

        <form name="form_search" id="form_search" method="_post" action="stream.php" ENCTYPE="multipart/form-data">
     
<div class="container back_white"> 
    
    <section class="ac-container">
        <article class="ac-medium"> 
            
            <div id="indicateur">
                <p><strong>Jeu</strong><br>
                <br>
                jeu :<br>
                
                    <select class="dropdown1" name="jeu" id="jeu" autocomplete="off" style="width: 99%;">
                        <option value="" id="option_debugger">Selectionnez une option</option>
                       <?php $controlleurDB->get_jeux(); ?>
                    </select>
                
                <br>         

        </div>  



            
            <div id="button_recherche">
                
               <!-- <input id="label" type="submit" value="Rechercher" /> -->
                
                <input id="label" type="submit" value="Rechercher"   />
                
          
                
            </div>
            
    </section>
</form>   
</div>
        
<?php 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ICI JE VERIFIE QUE TOUT LES CHAMPS DE FILTRE SONT REMPLIS, SI CE N'EST PAS LE CAS, JE N'AFFICHE PAS LE TABLEAU ET EN PLUS //
// JE DIS QUELS CHAMPS NE SONT PAS REMPLIS                                                                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$jeu =$_GET['jeu'];
if($jeu != NULL){    
          include './stream_result.php'; 
}
         
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                  Quand tout est bon, j'affiche le tableau                                                                 //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
?>


     </body>



</html>


