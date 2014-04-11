<div class="container_absolute_top"><div class="barres_top">
   <?php
   if (is_log()) {
     echo '<div class="barre_connexion">';
     echo '<a href="?page=accueil"> Accueil </a>';
     echo '<a href="?page=messages"> Messages </a>';
     echo '<a href="?page=profil"> Profil </a>';
     echo '<a href="?page=deconnexion"> Deconnexion </a>';
     echo '</div>';
   } else {
     ?>
     <div class="barre_connexion">
       <a href="?page=accueil">Accueil</a> <a href="?page=connexion">Connexion</a> <a href="?page=inscription">Inscription</a>
       </div>
       <?php
       }
?>	
<div class="barre_jeux"> 
   <a href="?page=dota2">Dota2</a> <a href="?page=wow">WOW</a> <a href="?page=sc2">SC2</a> <a href="?page=lol">LOL</a> <a href="?page=hearthstone">Hearthstone</a> <a href="?page=csgo">CS:GO</a>
   <a href="?page=streetfighter">StreetFighter</a> <a href="?page=umvc">UMVC</a>
   </div>
   </div></div>