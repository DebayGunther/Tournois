<?php 
require './inc/header.php';
require './inc/Includes/lib_include.php';

logged_only();

?>




<style>
    #palmares{
        
        background-color: #95a5a6;
        height: 210px;
        width: 200px;
        text-align: center;
        margin-left: 5px;
    }
    
    .projet{
        display: inline-block;
    }
    
</style>

<div class="container back_white"> 
<br>
    <section class="ac-container">
       <article class="ac-medium"> 

           <h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
           
           <div id="information" class="projet">
           <h1>Information sur le compte</h1>
           
           Nom d'utilisateur : <?= $_SESSION['auth']->username; ?>
           <br>
           Adresse mail : <?= $_SESSION['auth']->email; ?>
           <br>


           </div>
           
      
    </section>
</div>


<br>
<a href="http://localhost/TFE/changepwd.php"> <input type="button" value="changer de mot de passe" style="margin-left: 70px;"></a>


<div class="container back_white"> 
<br>
    <section class="ac-container">
       <article class="ac-medium"> 

           <h1>Palmarés</h1>
           
           
               
               
               
              
<?php 

require './Controlleur/ControlleurDB.class.php';
                   
$controlleurDB = new ControlleurDB;
$controlleurDB->get_all_palmares($_SESSION['auth']->username);


                   

?>
             
                   
         
               

               
           </div>
      
    </section>
</div>


