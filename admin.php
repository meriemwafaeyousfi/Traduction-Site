<?php
require_once('vue.php');
require_once('modele.php');

Class Admin
{

  public function minu(){
    ?>
    <ul id="menu">
  <li ><a href="adminpage.php">Acceuil</a></li>
  <li><a href="./catTraducteur.php">Traducteurs</a></li>
  <li ><a href="./catClient.php" >Client</a></li>
  <li ><a href="tabDevis.php">document</a></li>
  <li ><a href="bord.php">statistique</a></li> 
</ul>
<?php
  }
    public function categories(){
      $this->minu();
        ?>
        <div id="cat" style="padding: 1%;margin-top:9%">
        <div class="card " style="width: 14rem; display: inline-block;height:300px;margin:10px">
        <img src="image/trad.JPG" class="card-img-top" alt="..."style="height:60%">
        <div class="card-body">
        <p class="card-text"><b><a href="catTraducteur.php"> Traducteurs</a></b> <br> modifier , supprimer ou bloquer un traducteur</p>
        </div>
        </div>
        <div class="card " style="width: 14rem; display: inline-block;height:300px;margin:10px">
        <img src="image/cli.JPG" class="card-img-top" alt="..." style="height:60%">
        <div class="card-body">
        <p class="card-text"><b><a href="catClient.php"> Clients</a></b> <br> modifier , supprimer ou bloquer un client</p>
        </div>
        </div>
        <div class="card " style="width: 14rem; display: inline-block;height:300px;margin:10px">
        <img src="image/doc.JPG" class="card-img-top" alt="..." style="height:60%">
        <div class="card-body">
        <p class="card-text"><b><a href="tabDevis.php">gestion de documents</a></b> <br> consulter, trier et supprimer  un document</p>
        </div>
        </div>
        <div class="card " style="width: 14rem; display: inline-block;height:300px;margin:10px">
        <img src="image/cta4.JPG" class="card-img-top" alt="..." style="height:60%">
        <div class="card-body">
        <p class="card-text"><b><a href="bord.php">statistique</a></b> <br> consulter les statistiques des traductions</p>
        </div>
        </div>
        
        <div class="card " style="width: 14rem; display: inline-block;height:300px;margin:10px">
        <img src="image/hola.JPG" class="card-img-top" alt="..." style="height:60%">
        <div class="card-body">
        <p class="card-text"><b><a href="">wordpress</a></b> <br>partie de gestion de site depuis wordpress</p>
        </div>
        </div>
        
        </div>
<?php
    }
    /********************************************categorie traducteur****************** */

    public function tab_traducteur(){

         $Manager=new accueil();
        $Manager->entete();
        $this->minu();
          
        
          $c=new modele();
          $con=$c->connexion("localhost","root","","projet");
          ?> 
          <div style="margin-top : 5%"> 

          <h3>Table de traducteurs</h3> <br>
          
          <div id="dropdown2" class="dropdown">
          <span class="btn btn-secondary dropdown-toggle" type="button">trier</span>
          <div id="dropdown-content2" >
          <a class="dropdown-item" href="#" onclick="sortTable(0)">par pseudo</a>
          <a class="dropdown-item" href="#" onclick="sortTable(1)">par nom</a>
          <a class="dropdown-item" href="#" onclick="sortTable(2)">par email</a>
          </div>
          </div> 
          
<input type="text" id="myInput" onkeyup="filtrer(0)" placeholder="chercher un nom .." title="Type in a name"></input>
        <table id="myTable">
        <tr >
        <th >Pseudo</th>
        <th >Nom et prenom</th>
        <th>email</th>
        <th>adresse</th>
        <th>langue </th>
        <th>type </th>
        <th>Status</th>
        <th>modifier </th>
        <th>blocker </th>
        <th>supprimer </th>
        </tr>
          <?php
          
          $infos=$con->prepare('SELECT * FROM client WHERE traducteur = TRUE ');
          $infos->execute();
         
      
          while ( $resultat=$infos->fetch()){
           //recuperer les donnees de la bdd client
           
          $nom=$resultat['nom'];
          $prenom = $resultat['prenom'];
          $date = $resultat['date'];
          $adresse = $resultat['adresse'];
          $email = $resultat['email'];
          $pseudo = $resultat['pseudo'];
          $password = $resultat['password'];
          $lang = $resultat['langue'];
          $type = $resultat['typetrd'];  
          $status = $resultat['confirmed'];  
          $blocked=   $resultat['blocked'];  
      ?><tr> <td><a href=<?php echo "consulterTraducteur.php?pseudo=".$pseudo;?>> <?php echo $pseudo ?></a></td><?php
    ?><td><?php echo $nom." ".$prenom ?></td><?php
    ?><td><?php echo $email ?></td><?php
    ?><td><?php echo $adresse ?></td><?php
    ?><td><?php echo $lang ?></td><?php
    ?><td><?php echo $type ?></td><?php
    ?><td><?php if($status==false){echo "traducteur non confirmé"; }else{echo "traducteur confirmé";} ?></td><?php
    ?><td><a href="">✏️ modifier</a> </td><?php
    ?><td><a href=<?php echo "blockTraducteur.php?pseudo=".$pseudo.'&'.'bloc='.$blocked;?>>⛔️ <?php if($blocked==false){echo "Blocker"; }else{echo "Déblocker";} ?></a> </td><?php
    ?><td><a href=<?php echo "supTraducteur.php?pseudo=".$pseudo;?>>🗑supprimer</a> </td><?php
    ?></tr><?php
	}
  ?>
   </table>
 </div> 
 
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function filtrer(n) {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[n];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
 </body>
        </html>
  <?php
     

    }
public function consulter_traducteur($ps){
    
    $c=new modele();
    $v=new accueil();
    $con=$c->connexion("localhost","root","","projet");
    //pour remplir les données de formulaire de modification
     $infos=$con->prepare("SELECT * FROM client WHERE pseudo ='$ps'");
      $infos->execute();
      $resultat=$infos->fetch();
     //recuperer les donnees de la bdd client
    $nom=$resultat['nom'];
    $id=$resultat['id'];
    $prenom = $resultat['prenom'];
    $date = $resultat['date'];
    $adresse = $resultat['adresse'];
    $email = $resultat['email'];
    $pseudo = $resultat['pseudo'];
    $lang = $resultat['langue'];
    $type = $resultat['typetrd'];
    $password = $resultat['password'];
    $confirme = $resultat['confirmed'];
    $cv = $resultat['cv1'];
    $cv2 = $resultat['cv2'];
    $cv3 = $resultat['cv3'];
    $ass = $resultat['assurmentation'];
    $bloc = $resultat['blocked'];
    
    $v->entete();
    $this->minu();
  
    ?> 
    
    
<div class="card"  style="display : inline-block ; width : 30%; min-height:600px;margin-top : 5%">
  <img src="image/user.JPG" class="card-img-top" alt="..." style=" height: 50%;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $pseudo; ?></h5>
    <p class="card-text">Traducteur en langue <?php echo $lang."e"; ?> des document de type <?php echo $type; ?> </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Nom complet : <?php echo $nom." ".$prenom; ?></li>
    <li class="list-group-item">Adresse : <?php echo $adresse; ?></li>
    <li class="list-group-item">Date de naissance : <?php echo $date; ?></li>
    <li class="list-group-item">status : <?php echo "traducteur confirmé";?></li>
    <a class="list-group-item" style="display:block" href=<?php echo "blockTraducteur.php?pseudo=".$pseudo.'&'.'bloc='.$bloc;?>>⛔️ <?php if($bloc==FALSE){echo "Blocker"; }else{echo "Déblocker";} ?></a> 
  </ul>
  <div class="card-body">
    <p>🔗References de traducteur :</p>
    <a  class="card-link" href=<?php echo $cv; ?>>Reference1  </a>
    <?php  if($cv2 != NULL) {?>
    <a  class="card-link" href=<?php echo $cv2; ?>>References2 </a>
    <?php } if($cv3 != NULL) {?>
    <a  class="card-link" href=<?php echo $cv3; ?>>References3</a>
    <?php } if($ass != NULL) {?>
    <a  class="card-link" href=<?php echo $ass; ?>>assurmentation</a> 
    <?php  } ?>
  </div>

</div>
<?php if ($confirme==TRUE) { ?>
 <div class="historique" style="display : inline-block ; width : 67% ;margin-top : 5%">
   <h2>historique des traductions</h2> <br>
   <table>
   <tr>
    <th>Date</th>
    <th>nom de client</th>
    <th>compte de client</th>
    <th>email de client</th>
    <th>type de traduction</th>
    <th>langue source</th>
    <th>langue origine</th>
    <th>document traduit</th>
  </tr>
  
  <?php 
   //recuperer les donnees de la bdd devis
   
 //pour remplir les données de tableau d'historique 

 $infos2=$con->prepare('SELECT * FROM devis WHERE idtraducteur = ? ');
 $infos2->execute(array($id)); 
   while ($val = $infos2->fetch()) 
	{
    ?> <tr> <?php
    $n=$val['nomc'];
    $p=$val['prenomc'];
    $type=$val['typetraduction'];
    $source = $val['langsource'];
    $origine = $val['langvolu'];
    $doc = $val['document'];
    $d=$val['dateD'];
    $id2=$val['idclient'];
    $infos3=$con->prepare('SELECT * FROM client WHERE id = ? ');
    $infos3->execute(array($id2));
    $val2 = $infos3->fetch();
    $client=$val2['pseudo'];
    $clientm=$val2['email'];
    if(!$client){ $client="<i style='color: gray;'> non disponible </i>";}
    ?><td><?php echo $d ?></td><?php
    ?><td><?php echo $n." ".$p; ?></td><?php
    ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=".$client; ?>><?php echo $client; ?></a></td><?php
    ?><td><?php if($clientm!=NULL){echo $clientm;}else{echo "<i style='color: gray;'> non disponible </i>";} ?></td><?php
    ?><td><?php echo $type ?></td><?php
    ?><td><?php echo $source ?></td><?php
    ?><td><?php echo $origine ?></td><?php
    ?><td><a href=<?php echo $doc ?>> 🔗lien vers le document traduit</a></td><?php
    ?></tr><?php
	}
  ?>
   </table>
 </div> 
 
  <?php
}else{
  ?>
   <div class="historique" style="display : inline-block ; width : 67% ;padding:10%;  border: 1px solid rgb(210, 210, 231);">
   <center>
   <h3>Ce traducteur n'a pas était encore confirmer ! </h3> <br>
   <button type="button" class="btn btn-primary btn-lg"><a href=<?php echo "confirmeTraducteur.php?pseudo=".$pseudo;?> style=" text-decoration: none;color:white"> ✔️ confirmer le traducteur</a></button>
<button type="button" class="btn btn-secondary btn-lg"><a href=<?php echo "supTraducteur.php?pseudo=".$pseudo;?> style=" text-decoration: none;color:white">🗑 ignorer</a></button>
</center>
  </div>
  </body>
        </html>
  <?php
}
    
}
/******************************************************categorie client********************* */

public function tab_client(){

  $Manager=new accueil();
 $Manager->entete();
 $this->minu();
   
 
   $c=new modele();
   $con=$c->connexion("localhost","root","","projet");
   //pour remplir les données de formulaire de modification
   ?>
   <div style="margin-top : 5%">
   <h3>Table de clients</h3> <br>
   <div id="dropdown2" class="dropdown">
          <span class="btn btn-secondary dropdown-toggle" type="button">trier</span>
          <div id="dropdown-content2" >
          <a class="dropdown-item" href="#" onclick="sortTable(0)">par pseudo</a>
          <a class="dropdown-item" href="#" onclick="sortTable(1)">par nom</a>
          <a class="dropdown-item" href="#" onclick="sortTable(2)">par email</a>
          </div>
          </div> 
          
<input type="text" id="myInput" onkeyup="filtrer(0)" placeholder="chercher un nom .." title="Type in a name"></input>
 <table id="myTable">
 <tr>
 <th>Pseudo</th>
 <th>Nom et prenom</th>
 <th>email</th>
 <th>adresse</th>
 <th>sexe</th>
 <th>modifier </th>
 <th>blocker </th>
 <th>supprimer </th>
 </tr>
   <?php
   
   $infos=$con->prepare("SELECT * FROM client WHERE traducteur = FALSE ");
   $infos->execute();
  

   while ( $resultat=$infos->fetch()){
    //recuperer les donnees de la bdd client
    if ( $resultat['pseudo'] !="admin"){
   $nom=$resultat['nom'];
   $prenom = $resultat['prenom'];
   $date = $resultat['date'];
   $adresse = $resultat['adresse'];
   $email = $resultat['email'];
   $pseudo = $resultat['pseudo'];
   $sexe = $resultat['sexe'];
   $password = $resultat['password'];
   $blocked=   $resultat['blocked']; 
    
?><td><a href=<?php echo "consulterTraducteur.php?pseudo=".$pseudo;?>> <?php echo $pseudo ?></a></td><?php
?><td><?php echo $nom." ".$prenom ?></td><?php
?><td><?php echo $email ?></td><?php
?><td><?php echo $adresse ?></td><?php
?><td><?php echo $sexe?></td><?php

?><td><a href="">✏️ modifier</a> </td><?php
?><td><a href=<?php echo "blockTraducteur.php?pseudo=".$pseudo.'&'.'bloc='.$blocked;?>>⛔️ <?php if($blocked==false){echo "Blocker"; }else{echo "Déblocker";} ?></a> </td><?php
?><td><a href=<?php echo "supTraducteur.php?pseudo=".$pseudo;?>>🗑supprimer</a> </td><?php
?></tr><?php
}
   }
?>
</table>
</div> 
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function filtrer(n) {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[n];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
 </body>
        </html>
<?php


}


public function consulter_client($ps){
    
  $c=new modele();
  $v=new accueil();
  $con=$c->connexion("localhost","root","","projet");
  //pour remplir les données de formulaire de modification
   $infos=$con->prepare("SELECT * FROM client WHERE pseudo ='$ps'");
    $infos->execute();
    $resultat=$infos->fetch();
   //recuperer les donnees de la bdd client
  $nom=$resultat['nom'];
  $id=$resultat['id'];
  $prenom = $resultat['prenom'];
  $date = $resultat['date'];
  $adresse = $resultat['adresse'];
  $email = $resultat['email'];
  $pseudo = $resultat['pseudo'];
  $password = $resultat['password'];

  $v->entete();
  $this->minu();

  ?> 
  

<div class="card"  style="display : inline-block ; width : 30%; height:600px;margin-top : 5%">
<img src="image/user.JPG" class="card-img-top" alt="..." style=" height: 50%;">

<ul class="list-group list-group-flush">
  <li class="list-group-item">Nom complet : <?php echo $nom." ".$prenom; ?></li>
  <li class="list-group-item">Adresse : <?php echo $adresse; ?></li>
  <li class="list-group-item">Date de naissance : <?php echo $date; ?></li>
</ul>


</div>

<div class="historique" style="display : inline-block ; width : 67% ;margin-top : 5%">
 <h2>historique des devis</h2> <br>
 <table>
 <tr>
  <th>Date</th>
  <th>nom </th>
  <th>compte de traducteur</th>
  <th>email de traducteut</th>
  <th>type de traduction</th>
  <th>langue source</th>
  <th>langue origine</th>
  <th>document traduit</th>
  
</tr>

<?php 
 //recuperer les donnees de la bdd devis
 
//pour remplir les données de tableau d'historique 


$infos2=$con->prepare('SELECT * FROM devis WHERE idclient = ? ');
$infos2->execute(array($id)); 
 while ($val = $infos2->fetch()) 
{
  ?> <tr> <?php
  $n=$val['nomc'];
  $p=$val['prenomc'];
  $type=$val['typetraduction'];
  $source = $val['langsource'];
  $origine = $val['langvolu'];
  $doc = $val['document'];
  $d=$val['dateD'];
  $id2=$val['idtraducteur'];
  $infos3=$con->prepare('SELECT * FROM client WHERE id = ? ');
  $infos3->execute(array($id2));
  $val2 = $infos3->fetch();
  $trad=$val2['pseudo'];
  $tradm=$val2['email'];
  if(!$trad){ $trad = "non disponible";}
  ?><td><?php echo $d ?></td><?php
  ?><td><?php echo $n." ".$p; ?></td><?php
  ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=".$trad; ?>><?php echo $trad; ?></a></td><?php
  ?><td><?php if($tradm!=NULL){echo $tradm;}else{echo "<i style='color: gray;'> non disponible </i>";}?></td><?php
  ?><td><?php echo $type ?></td><?php
  ?><td><?php echo $source ?></td><?php
  ?><td><?php echo $origine ?></td><?php
  ?></tr><?php
}
?>
 </table>
</div> 
</body>
        </html>
<?php

 
}
/************************************************************categorie 3 : document****************** */
public function tab_document(){
  $Manager=new accueil();
  $Manager->entete();
  $this->minu();
  $c=new modele();
  $v=new accueil();
  $con=$c->connexion("localhost","root","","projet");

$infos=$con->prepare('SELECT * FROM devis');
$infos->execute(); 
?>
<div style="margin-top : 5%">
 <h2>liste de devis</h2> <br>
 <div id="dropdown2" class="dropdown" >
          <span class="btn btn-secondary dropdown-toggle" type="button">trier</span>
          <div id="dropdown-content2" >
          <a class="dropdown-item" href="#" onclick="sortTable(0)">par date</a>
          <a class="dropdown-item" href="#" onclick="sortTable(1)">par type</a>
          <a class="dropdown-item" href="#" onclick="sortTable(2)">par pseudo client</a>
          <a class="dropdown-item" href="#" onclick="sortTable(5)">par pseudo traducteur</a>
          <a class="dropdown-item" href="#" onclick="sortTable(8)">par langue source </a>
          <a class="dropdown-item" href="#" onclick="sortTable(9)">par langue de traduction</a>
          </div>
          </div> 
 <p style="display: inline-block;"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspchoisissez un option de recherche :&nbsp&nbsp  </p><input type="button" name="client" value="client"/>
<input type="button" name="traducteur" value="traducteur" />
<input type="button" name="source" value="langue source"/>
<input type="button" name="traduit" value="langue traduit"/> <br>
<input type="text" id="myInput2" onkeyup="filtrer(2)" placeholder="chercher le nom de client.." title="Type in a name" style="width:30%;"></input> 
<input type="text" id="myInput5" onkeyup="filtrer(5)" placeholder="chercher le nom de traducteur.." title="Type in a name" style="display:none ;width:30%;"></input> 
<input type="text" id="myInput7" onkeyup="filtrer(7)" placeholder="chercher une langue source .." title="Type in a name" style="display:none; width:30%;"></input> 
<input type="text" id="myInput8" onkeyup="filtrer(8)" placeholder="chercher une langue de traduction.." title="Type in a name" style="display:none; width:30%;"></input> 

</div>

 <table id="myTable" style="display : block ; width : 100%;">
 <tr>
  <th>Date de demande</th>
  <th>type de document </th>
  <th>compte de client</th>
  <th>email de client</th>
  <th>compte de traducteur</th>
  <th>email de traducteut</th>
  <th>status de traduction</th>
  <th>payement</th>
  <th>langue source</th>
  <th>langue de traduction</th>
  <th>document origine</th>
  <th>document traduit</th>
  <th>confirmer le payement de client</th>
  <th>supprimer</th>
</tr>

<?php 
 while ($val = $infos->fetch()) 
{
  ?> <tr> <?php
  $idevis=$val['iddevis'];
  $c=$val['conf'];
  $d=$val['dateD'];
  $type=$val['typetraduction'];
  $id1=$val['idclient'];
  $infos1=$con->prepare('SELECT * FROM client WHERE id = ? ');  
  $infos1->execute(array($id1));
  $val1 = $infos1->fetch();
  $client=$val1['pseudo'];
  $clientm=$val1['email'];
  $id2=$val['idtraducteur'];
  $infos2=$con->prepare('SELECT * FROM client WHERE id = ? ');  
  $infos2->execute(array($id2));
  $val2 = $infos2->fetch();
  $trad=$val2['pseudo'];
  $tradm=$val2['email'];
  $source = $val['langsource'];
  $origine = $val['langvolu'];
  $state=$val['statusD'];
  $doc = $val['document'];
  $doct = $val['doctraduit'];
  $pay = $val['payement'];
  if($client==NULL){ $client="non disponible";}
  if($clientm==NULL){ $clientm=" non disponible ";}
  if($trad==NULL){ $trad="non disponible ";}
  if($tradm==NULL){ $tradm=" non disponible ";}

  ?><td><?php echo $d ?></td><?php
  ?><td><?php echo $type ?></td><?php
  ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=".$client; ?>><?php echo $client; ?></a></td><?php
  ?><td><?php echo $clientm; ?></td><?php
  ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=".$trad; ?>><?php echo $trad; ?></a></td><?php
  ?><td><?php echo $tradm; ?></td><?php

  ?><td><?php if($state==0){echo "document pas encore confirmé";}elseif($state==1){echo "document en cours de traduction";}else{echo "document traduit";} ?></td><?php
  ?><td><?php if($pay==0){echo "devis non payé";}else{echo "devis payé";} ?></td><?php
  ?><td><?php echo $source?></td><?php
  ?><td><?php echo $origine ?> </td><?php
  ?><td> <a href=<?php echo $doc ?>> 🔗lien </a></td><?php
  ?><td><a href=<?php echo $doct ?>> 🔗lien </a></td><?php
  ?><td><a href=<?php echo "confirmePrix.php?iddevis=".$idevis;?>>✔️ <?php if($c==false){echo "confirmer"; }else{echo "Déja confirmer";} ?></a> </td><?php
  ?><td><a href=<?php echo "supDevis.php?id=".$idevis;?>  style=" text-decoration: none;">🗑 </a> </td><?php
  ?></tr><?php
}
?>
 </table>

 <script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function filtrer(n) {
  var input, filter, table, tr, td, i, txtValue;
  var str1= "myInput";
  var res = str1.concat(n);
  input = document.getElementById(res);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[n];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
$(document).ready(function (){
  $("input[name=client]").click(function(){
    document.getElementById("myInput2").style.display = "block";
    document.getElementById("myInput5").style.display = "none";
    document.getElementById("myInput7").style.display = "none";
    document.getElementById("myInput8").style.display = "none";
    
});
});
$(document).ready(function (){
$("input[name=traducteur]").click(function(){
    document.getElementById("myInput5").style.display = "block";
    document.getElementById("myInput2").style.display = "none";
    document.getElementById("myInput7").style.display = "none";
    document.getElementById("myInput8").style.display = "none";
    
});
});
$(document).ready(function (){
$("input[name=source]").click(function(){
    document.getElementById("myInput7").style.display = "block";
    document.getElementById("myInput5").style.display = "none";
    document.getElementById("myInput2").style.display = "none";
    document.getElementById("myInput8").style.display = "none";
    
});
});
$(document).ready(function (){
$("input[name=traduit]").click(function(){
    document.getElementById("myInput8").style.display = "block";
    document.getElementById("myInput5").style.display = "none";
    document.getElementById("myInput7").style.display = "none";
    document.getElementById("myInput2").style.display = "none";
    
});
});

</script>
</body>
</html>
<?php 

}
/*********************************************************cotegorie4: statistique********************* */
public function tab_bord(){
  $Manager=new accueil();
  $Manager->entete();
  $this->minu();
  ?>
  <center>
  <br>
  <h3> pour afficher les statistique d'une periode , entrez deux dates</h3>
  <form action="affich_tab.php" method="post" style=" width:50% ; height:50%;margin : 10%;padding:2%; background-color:rgb(197, 149, 236)">
  <br> <label>  Date 1 : </label> 
  <input type="date" name="date1" required="required"/> <br> <br> 
  <label>  Date 2 : </label> 
  <input type="date" name="date2" required="required"/><br><br><br><br>
  <button type="submit" name="submit" class="btn" >afficher le tableau de bord</button>
  </form>
  </center>
 
  <?php

}
/*******************************************************affichage acceuil admin ********************** */
    
    public function afficher_admin(){
        $Manager=new accueil();
        $Manager->entete();
        $this->categories();
        ?>
        </body>
        </html>
        <?php
    }
}




?>