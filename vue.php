<?php
session_start();
require_once('controller.php');
require_once('modele.php');

Class accueil{


  public function entete(){
    
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js.js"></script>
<meta charset="utf-8"/>

<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
<link rel="stylesheet" type="text/css" href="file:///C:/wamp64/www/tdw/fontawesome/css/all.css"> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload="navBar()">
<?php
   
    }

public function headbar(){
      ?>
 
  <div class="headbar">
  <img id="logo" src="image\logo.png" alt=""/> 

<div class="icon-bar" >
  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>

</div>
  </div> 
  <?php
  }
public function menu(){
?>
<ul id="menu">
  <li ><a href="index.php">Acceuil</a></li>
  <li><a href="./liste_traducteur.php">Traducteurs</a></li>
  <li ><a href="./traduction.php" >Traduction</a></li>
  <li ><a href="recrutement.php">Recrutement</a></li>
  <li ><a href="#news">Blog</a></li> 
  <li ><a href="#news">à propos</a></li>
  <li id="dropdown"><a class="dropbtn" id="profil" href="#news" style="display : none;">mon profil</a>
  <div id="dropdown-content">
      <a href="./profilclient.php">Mon compte</a>
      <a href="./deconnect.php">Deconnexion</a>
    </div>
  </li>
  <li id="dropdown2"><a class="dropbtn" id="notif" href="" style="display : none;">🔔notifications</a>
     <div id="dropdown-content2">
      <a id="notif1" href="notif.php">nouvelles demendes de traduction</a>
      <a id="noti1" href="noti.php">devis payés et en cours de traduction</a>
      </div>
  </li>

  <li id="dropdown3"><a class="dropbtn" id="notiff" href=""  style="display : none;">🔔notifications</a>
  <div id="dropdown-content3">
      <a id="notif2" href="notif2.php">nouvelles demendes de traduction</a>
      <a id="noti2" href="noti2.php">devis payés et en cours de traduction</a>
      </div>
  </li>

</ul> 
    <?php
    if(isset($_SESSION['id'])&&isset($_SESSION['pseudo'])){    
            ?>
    <script>
    
        if (document.getElementById("profil").style.display=="none") {
      // alert("im here");
       document.getElementById("profil").style.display = "block";
       
        }
     </script>
    <?php
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    $h=$_SESSION['id'];
    $sql=$bdd->prepare("SELECT * FROM client WHERE id ='$h' ");
    $sql->execute();
    $res = $sql->fetch();
    
    if($res['traducteur']){
   $sql2=$bdd->prepare("SELECT * FROM notifications WHERE idtr ='$h' and con = FALSE ");                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    $sql2->execute();
    $number2=$sql2->rowCount();
    $sql3=$bdd->prepare("SELECT * FROM notifications WHERE idtr ='$h' and pay=TRUE and doc=FALSE");                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    $sql3->execute();
    $number3=$sql3->rowCount();
    ?>
    <script>
    var v = "<?php echo "nouvelles demendes de traduction (". $number2.")";?>";
    if (document.getElementById("notif").style.display=="none") {
      // alert("im here");
       document.getElementById("notif").style.display = "block";
       document.getElementById("notif1").innerHTML=v;
       
     }
     var v2 = "<?php echo "devis payé (". $number3.")";?>";
    
       document.getElementById("noti1").innerHTML=v2;
       
     
     </script>
     <?php
    }else{
    $sql2=$bdd->prepare("SELECT * FROM notifications WHERE idcl ='$h' and con = TRUE and payreq=FALSE");                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    $sql2->execute();
    $number2=$sql2->rowCount();
    $sql3=$bdd->prepare("SELECT * FROM notifications WHERE idcl ='$h' and doc=TRUE");                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    $sql3->execute();
    $number3=$sql3->rowCount();
      ?>
      <script>
      var v = "<?php echo "demandes acceptés (". $number2.") " ; ?>";
      if (document.getElementById("notiff").style.display=="none") {
        // alert("im here");
         document.getElementById("notiff").style.display = "block";
         document.getElementById("notif2").innerHTML=v;
         
       }
       var v2 = "<?php echo "traductions terminés (". $number3.")";?>";
    
    document.getElementById("noti2").innerHTML=v2;
       </script>
       <?php 
    }
    }

    }

public function affich_notif(){

    $this->entete();
    $this->headbar();
    $this->menu();
    if(isset($_GET['devis'])) if ($_GET['devis']) {
     
      $this->choisir_prix($_GET['devis']);
      }
      ?>
      <h2>nouvelles demandes de traductions </h2>
 <table  style="display : block ; width : 100%; margin-top : 5%; margin-bottom : 5%">
 <tr>
  <th>Date de demande</th>
  <th>type de document </th>
  <th>nom de client </th>
  <th>email de client</th>
  <th>langue source</th>
  <th>langue de traduction</th>
  <th>document a traduire</th>
  <th>confirmer la traduction</th>
  <th>rejeter la traduction</th>
</tr>

<?php
$c=new modele();
$con=$c->connexion("localhost","root","","projet");
$h=$_SESSION['id'];
$infos1=$con->prepare("SELECT * FROM notifications where idtr ='$h' and con = FALSE");
$infos1->execute();
$i1=$infos1->fetchall();
foreach( $i1 as $row){
$h2=$row["idcl"];
$h3=$row["idevis"];
$infos=$con->prepare("SELECT * FROM devis where idtraducteur ='$h' and idclient='$h2' and iddevis='$h3' ");
$infos->execute(); 
 $val = $infos->fetch();

  ?> <tr> <?php
  $idevis=$val['iddevis'];
  $d=$val['dateD'];
  $type=$val['typetraduction'];
  $id1=$val['idclient'];
  $infos1=$con->prepare('SELECT * FROM client WHERE id = ? ');  
  $infos1->execute(array($id1));
  $val1 = $infos1->fetch();
  $client=$val1['nom'];
  $clientm=$val1['email'];
  $source = $val['langsource'];
  $origine = $val['langvolu'];
  $doc = $val['document'];
  
  if($client==NULL){ $client="non disponible";}
  if($clientm==NULL){ $clientm=" non disponible ";}
  
  ?><td><?php echo $d ?></td><?php
  ?><td><?php echo $type ?></td><?php
  ?><td><?php echo $client; ?></td><?php
  ?><td><?php echo $clientm; ?></td><?php
  ?><td><?php echo $source?></td><?php
  ?><td><?php echo $origine ?> </td><?php
  ?><td> <a href=<?php echo $doc ?>> 🔗lien </a></td>
  <td><a href=<?php echo "notif.php?devis=".$idevis; ?> > valider ✔️</a> </td><?php
  ?><td><a href="">rejeter 🗑 </a> </td><?php
  ?></tr>
  <?php
}

?>
 </table>
<?php
$this->footer();
}

public function affich_noti(){

  $this->entete();
  $this->headbar();
  $this->menu();
  if(isset($_GET['devis'])) if ($_GET['devis']) {
   
    $this->deposer_document($_GET['devis']);
    }
    ?>
    <h2> les demandes de traductions payé </h2>
<table  style="display : block ; width : 100%; margin-top : 5%; margin-bottom : 5%">
<tr>
<th>Date de demande</th>
<th>type de document </th>
<th>nom de client </th>
<th>email de client</th>
<th>langue source</th>
<th>langue de traduction</th>
<th>document a traduire</th>
<th>status de traduction</th>
<th>traduction terminé</th>
</tr>

<?php
$c=new modele();
$con=$c->connexion("localhost","root","","projet");
$h=$_SESSION['id'];
$infos1=$con->prepare("SELECT * FROM notifications where idtr ='$h' and pay = TRUE and doc= FALSE");
$infos1->execute();
$i1=$infos1->fetchall();
foreach( $i1 as $row){
$h2=$row["idcl"];
$h3=$row["idevis"];
$infos=$con->prepare("SELECT * FROM devis where idtraducteur ='$h' and idclient='$h2' and iddevis='$h3' ");
$infos->execute(); 
$val = $infos->fetch();

?> <tr> <?php
$idevis=$val['iddevis'];
$doc1=$val['doctraduit'];
$d=$val['dateD'];
$type=$val['typetraduction'];
$id1=$val['idclient'];
$infos1=$con->prepare('SELECT * FROM client WHERE id = ? ');  
$infos1->execute(array($id1));
$val1 = $infos1->fetch();
$client=$val1['nom'];
$clientm=$val1['email'];
$source = $val['langsource'];
$origine = $val['langvolu'];
$doc = $val['document'];
$state = $val['statusD'];

if($client==NULL){ $client="non disponible";}
if($clientm==NULL){ $clientm=" non disponible ";}

?><td><?php echo $d ?></td><?php
?><td><?php echo $type ?></td><?php
?><td><?php echo $client; ?></td><?php
?><td><?php echo $clientm; ?></td><?php
?><td><?php echo $source?></td><?php
?><td><?php echo $origine ?> </td><?php
?><td> <a href=<?php echo $doc ?>> 🔗lien </a></td>
<td><?php if($state==0) {echo "document pas encore confirmé";}elseif($state==1){echo "document en cours de traduction";}else{echo "document traduit";} ?></td><?php
?><td><a href=<?php echo "noti.php?devis=".$idevis; ?>> <?php if($doc1==NULL){echo "delivrer la traduction "; }else{echo "traduction delivré ✔️";} ?></a> </td><?php
?></tr>
<?php
}

?>
</table>
<?php
$this->footer();
}

public function affich_noti2(){

  $this->entete();
  $this->headbar();
  $this->menu();
  ?>
    <h2> les traductions terminées </h2>

<table  style="display : block ; width : 100%; margin-top : 5%; margin-bottom : 5%">

<tr>
<th>Date de demande</th>
<th>type de document </th>
<th>nom de traducteur </th>
<th>email de traducteur</th>
<th>langue source</th>
<th>langue de traduction</th>
<th>document a traduire</th>
<th>fichier traduit</th>
<th>noter la traduction</th>
</tr>

<?php
$c=new modele();
$con=$c->connexion("localhost","root","","projet");
$h=$_SESSION['id'];

$infos1=$con->prepare("SELECT * FROM notifications where idcl ='$h' and doc= TRUE");
$infos1->execute();
$i1=$infos1->fetchall();


foreach( $i1 as $row){
$h2=$row["idtr"];

$h3=$row["idevis"];

$infos=$con->prepare("SELECT * FROM devis where idtraducteur ='$h2' and idclient='$h' and iddevis='$h3' ");
$infos->execute(); 
$val = $infos->fetch();

?> <tr><?php
$idevis=$val['iddevis'];
$doc1=$val['doctraduit'];
$d=$val['dateD'];
$type=$val['typetraduction'];
$id1=$val['idtraducteur'];
$infos1=$con->prepare('SELECT * FROM client WHERE id = ? ');  
$infos1->execute(array($id1));
$val1 = $infos1->fetch();
$client=$val1['nom'];
$clientm=$val1['email'];
$source = $val['langsource'];
$origine = $val['langvolu'];
$doc = $val['document'];
$doc1 = $val['doctraduit'];
$state = $val['statusD'];

if($client==NULL){ $client="non disponible";}
if($clientm==NULL){ $clientm=" non disponible ";}

?><td><?php echo $d ?></td><?php
?><td><?php echo $type ?></td><?php
?><td><?php echo $client; ?></td><?php
?><td><?php echo $clientm; ?></td><?php
?><td><?php echo $source?></td><?php
?><td><?php echo $origine ?> </td><?php
?><td> <a href=<?php echo $doc; ?> > 🔗lien </a></td>
<td> <a href=<?php echo $doc1; ?>> 🔗lien </a></td></tr>
<?php
}

?>
</table>
<?php
$this->footer();
}


public function affich_notif2(){

  $this->entete();
  $this->headbar();
  $this->menu();
    ?>
    <h2> les confirmations de vos demandes de devis :</h2>
<table  style="display : block ; width : 100%; margin-top : 5%; margin-bottom : 5%">
<tr>
<th>Date de demande</th>
<th>type de document </th>
<th>nom de traducteur </th>
<th>email de traducteur</th>
<th>langue source</th>
<th>langue de traduction</th>
<th>document a traduire</th>
<th>prix de traduction</th>
<th>confirmer la traduction</th>
<th>rejeter la traduction</th>
</tr>

<?php
$c=new modele();
$con=$c->connexion("localhost","root","","projet");
$h=$_SESSION['id'];
$infos1=$con->prepare("SELECT * FROM notifications where idcl ='$h' and con = TRUE and payreq = FALSE");
$infos1->execute();
$i1=$infos1->fetchall();
foreach( $i1 as $row){
$h2=$row["idtr"];
$h3=$row["idevis"];
$infos=$con->prepare("SELECT * FROM devis where idtraducteur ='$h2' and idclient='$h' and iddevis='$h3' ");
$infos->execute(); 
$val = $infos->fetch();

?> <tr> <?php
$idevis=$val['iddevis'];
$d=$val['dateD'];
$type=$val['typetraduction'];
$id1=$val['idtraducteur'];
$infos1=$con->prepare('SELECT * FROM client WHERE id = ? ');  
$infos1->execute(array($id1));
$val1 = $infos1->fetch();
$client=$val1['nom'];
$clientm=$val1['email'];
$source = $val['langsource'];
$origine = $val['langvolu'];
$prix = $val['prix'];
$doc = $val['document'];

if($client==NULL){ $client="non disponible";}
if($clientm==NULL){ $clientm=" non disponible ";}

?><td><?php echo $d ?></td><?php
?><td><?php echo $type ?></td><?php
?><td><?php echo $client; ?></td><?php
?><td><?php echo $clientm; ?></td><?php
?><td><?php echo $source?></td><?php
?><td><?php echo $origine ?> </td><?php

?><td> <a href=<?php echo $doc ?>> 🔗lien </a></td>
<td><?php echo $prix ?> </td>
<td><a href=<?php echo "validerPrix.php?devis=".$idevis ; ?> > confirmer le payement ✔️</a> </td><?php
?><td><a href="">rejeter 🗑 </a> </td><?php
?></tr>
<?php
}

?>
</table>
<?php
$this->footer();
}



    public function connexion() {
        ?>
        <center>
    <div class="form-popup" id="connexion">

   
    
      <form method="post" action="cnx.php" class="form-container">
        <h1>Se connecter
          <p  class="btn cancel" onclick="closeForm()">X</p>
        </h1>   
        <label>  Pseudo : </label> <br>    
        <input type="text" name="pseudo2" placeholder="Enter votre pseudonyme"  required/> 
        <label>  Mot de passe : </label> <br> 
        <input type="password" name="mot_pass" placeholder="Enter votre mot de passe" required="required" /> <br><br>
         <p >vous n'avez pas un compte?<b style="cursor: pointer;" onclick="openForm2()">inscrivez vous</b> </p>
        <button type="submit" class="btn">se connecter</button>
 
      </form>
   
    </div>
  </center>
  <?php
    } 

public function inscription() {    
?>
<center>
    <div class="form-popup" id="inscription">
    
      <form method="post" action="ins.php" class="form-container">
        <h1>S'inscrire
          <p  class="btn cancel" onclick="closeForm2()">X</p>
        </h1> 
        <div id="col1">
        <label>  Nom* : </label> <br>
        <input type="text" placeholder="Enter votre nom" name="nom" required/><br>
        <label>  Prénom* : </label> <br>
        <input type="text" placeholder="Enter votre prenom" name="prenom" required/> <br>
        <label>  Date naissance* : </label><br> 
        <input type="date" name="dateN" required="required"/><br>
        <label>  Adresse E-mail* : </label>  <br>   
        <input type="text" placeholder="Enter votre Email" name="email" required/> <br>     
        <label>  Sexe : </label> <br>
         <select name="sexe"> 
        <option value="Femme"> Femme </option>
        <option value="Homme"> Homme</option>    
        </select>  
        </div> 
        <div id="col2">
        <label> Adresse* : </label> <br>
        <input type="text" name="adresse" placeholder="Enter votre adresse" required="required" /><br>
        <label>   Pseudonyme* : </label><br>
        <input type="text" name="pseudo" placeholder="Enter un psodonyme" required="required" /><br>
        <label>  Mot de passe* : </label><br>
        <input type="password" name="mot_passe1"  required="required" /><br>
        <label>  Retaper le mot de passe* : </label><br>
        <input type="password" name="mot_passe2"  required="required" /> 
        </div>
        <button type="submit" name="submit" class="btn">s'inscrire</button>
        
      </form>
   
    </div>
  </center>
<?php
 }
 public function slideshow() {
     ?>
    <center>
    <div id="slideshow">		
            <div id="container">       
                <div id="slide">       
                        <img src="image\t1.jpg" alt=""  />    
                        <img src="image\t2.jpg" alt="" />
                        <img src="image\t3.jpeg" alt=""/>   
                        <img src="image\t4.jpg" alt="" />
                </div>
            </div>
      </div>
    </center>

    <?php
 }
public function afficher_articles() {
?>

<div class="contenu">
  <div class="article">
    <h2>article1</h2>
    <p>Les textes scientifiques et médicaux développent des idées complexes au moyen d’une terminologie à la fois spécifique et pointue. En raison de la diversité et de l’ampleur des différents domaines que comporte cette catégorie, notre agence de traduction scientifique et médicale sélectionne pour vous les traducteurs les mieux adaptés à chaque projet en tenant particulièrement compte de leurs expériences et de leur compréhension des termes scientifiques et médicaux. L’objectif est de s’assurer que la traduction reflète avec précision le sens du texte source.</p>
<button class="accordion">lire la suite</button>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>
</div>


  <div class="article">
    <h2>article2</h2>
    <p>Les textes scientifiques et médicaux développent des idées complexes au moyen d’une terminologie à la fois spécifique et pointue. En raison de la diversité et de l’ampleur des différents domaines que comporte cette catégorie, notre agence de traduction scientifique et médicale sélectionne pour vous les traducteurs les mieux adaptés à chaque projet en tenant particulièrement compte de leurs expériences et de leur compréhension des termes scientifiques et médicaux. L’objectif est de s’assurer que la traduction reflète avec précision le sens du texte source.</p>
<button class="accordion">lire la suite</button>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>
</div>

  <div class="article">
    <h2>article3</h2>
    <p>Les textes scientifiques et médicaux développent des idées complexes au moyen d’une terminologie à la fois spécifique et pointue. En raison de la diversité et de l’ampleur des différents domaines que comporte cette catégorie, notre agence de traduction scientifique et médicale sélectionne pour vous les traducteurs les mieux adaptés à chaque projet en tenant particulièrement compte de leurs expériences et de leur compréhension des termes scientifiques et médicaux. L’objectif est de s’assurer que la traduction reflète avec précision le sens du texte source.</p>
<button class="accordion">lire la suite</button>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>
</div>

</div>

<?php
 }
 
 public function choisir_prix($p){

  ?>  

<div style="  position: absolute;display: block;box-shadow: 3px 3px 6px grey;border: none; z-index:9; padding : 2%;  min-width: 50%; background-color : white ; margin-left: 5%;margin-right: 5%;margin-top: 5%;min-height:50%">
<form action=<?php echo "confirmeDevis.php?devis=".$p ; ?>  method = "post">
<h5>selectionner ule prix de traduction </h5>
 <input type="text" placeholder="entrer le prix de traduction" name="prix"  required>
 <input type="submit" value="valider" onclick="">
</form>
</div>
  
<?php 

}
public function deposer_document($p){

  ?>  

<div style="  position: absolute;display: block;box-shadow: 3px 3px 6px grey;border: none; z-index:9; padding : 2%;  min-width: 50%; background-color : white ; margin-left: 5%;margin-right: 5%;margin-top: 5%;min-height:50%">
<form action=<?php echo "deposerDocument.php?devis=".$p ; ?>  method = "post">
<h5>deposer le document traduit </h5>
<input  type="file" name="" required/> <br><br>
 <input type="submit" value="deposer" onclick="">
</form>
</div>
  
<?php 

}
 
public function choisir_traducteur(){
  ?>  
 
<div style="  position: absolute;display: block;box-shadow: 3px 3px 6px grey;border: none; z-index:9; padding : 2%;  min-width: 50%; background-color : white ; margin-left: 5%;margin-right: 5%;margin-top: 5%;min-height:50%">
<form action="choisir_traduction.php" method = "post">
<h5>selectionner un traducteur</h5>

<?php  

$c=new modele();
$lg= $_GET['langue'];
$t= $_GET['type'];
  $con=$c->connexion("localhost","root","","projet");
  //pour remplir les données de formulaire de modification
  
  
  $infos=$con->prepare("SELECT * FROM client WHERE traducteur = TRUE and langue = '$lg' and typetrd= '$t' and confirmed= TRUE ");
  $infos->execute();
  $default=NULL;
  while ( $resultat=$infos->fetch()  ){
    
 
  $default=$resultat['pseudo'];
  $nom=$resultat['nom'];
  $prenom = $resultat['prenom'];
  $ty = $resultat['typetrd'];
  $la = $resultat['langue'];
  $pseudo = $resultat['pseudo'];
  $adresse = $resultat['adresse'];
  $name= $nom."  ".$prenom;  //recuperer les donnees de la bdd client

?>
<div class="card"  style="display : inline-block ; width : 40%;margin-top : 1% , margin-right : 2% ;background-color: rgb(197, 149, 236); border-width: 5px;">
<input  type="radio" name="radio"  value= "<?php echo $pseudo; ?>" ><b style="font-size : 20px ; margin-left:20px"> <?php echo $pseudo; ?></b></input> 


<ul class="list-group list-group-flush">
  <li class="list-group-item">Nom complet : <?php  echo $name; ?></li>
  <li class="list-group-item">Adresse : <?php echo $adresse; ?></li>
  <li class="list-group-item">type de traduction : <?php echo $ty; ?></li>
  <li class="list-group-item">tlangue de traduction : <?php echo $la; ?></li>
</ul>

</div>
<?php 
}

$lastid =$_GET['iddevis'];
if($default==NULL){
  echo "y a pas de traducteur pour cette langue desolé ,<br> votre demande de devis va etre traiter ulterierement";
  ?>
 
  <button  class="btn btn-primary btn-lg"  style = " inline-block;float : right ; font-size: 16px; padding: 5px 25px;"> <a href="index.php" style="text-decoration: none;color : white;">terminer</a></button>
<?php
} else{
?>
<div style="display : block;margin-bottom : 0px; margin-top : 10%;">
<input  type="radio" name="radio"  value="<?php echo $default; ?>" style=" inline-block"  ><b> choisir un traducteur par defaut</b></input>
<input  type="hidden" name="hidden"  value= "<?php echo  $lastid; ?>" ></input>
<button type="submit" class="btn btn-primary btn-lg" style = "inline-block;float : right ; font-size: 16px; padding: 5px 25px;">choisir</button>
</div>
<?php
}
?>
</form>
</div>
  
<?php 

}


 
public function demande_devis() {
    ?>
    <div class="form">
    <form action="devis.php" method="post">
      <center><label style="font-size: 25px;">Demander un devis</label></center>
      <input type="text" placeholder="Enter votre nom" name="nom"  required>
      <input type="text" placeholder="Enter votre prénom" name="prenom"  required>
      <input type="text" placeholder="Enter votre adresse email" name="email" required>
      <input type="text" placeholder="Enter votre numéro de telephone" name="tel"  required>

      
      <label for="language">Type de traduction</label>
      <select name="type" id="disabledSelect" class="form-control"  required>
        <option value="scientifique">scientifique</option>
        <option value="general">general</option>
        <option value="siteweb">site web</option>
      </select>

      <label for="language">du</label>
      <select name="source" id="disabledSelect" class="form-control"  required>
        <option value="arabe">arabe</option>
        <option value="anglais">english</option>
        <option value="francais">francais</option>
      </select>

      <label for="language">vers</label>
      <select name="langue" id="disabledSelect" class="form-control" required>
        <option value="arabe">arabe</option>
        <option value="anglais">english</option>
        <option value="francais">francais</option>
      </select>
      <label for="comment">Votre Message</label>
      <textarea name="msg" class="form-control" rows="30" id="comment" placeholder="Message" ></textarea> <br>
      <label >le document a traduire :</label> <br>
      
      <input  type="file" name="" required/> <br><br>
  
      <div class="g-recaptcha" data-sitekey="6LexVc8UAAAAAFrnk1Jx6bf55Xy6G_X53nCC06t0"></div>

      <input type="submit" value="Submit" onclick="">
    </form>
  </div>

    <?php

}



public function partie_droite() {
    ?>
    
<div class="contenu" style="float: right;">
<div class="messageErreur">
										<?php
											if(isset($_GET['erreurcnx'])) if ($_GET['erreurcnx']) echo '<p>* Pseudo ou Mot de Passe incorrect</p>';
										?>
		</div>

<center>
  <button id="cnx" class="open-button " style="display:inline-block;" onclick="openForm()">connexion</button>
  <button id="dcnx" class="open-button "  style="display:none;" ><a href="./deconnect.php" style="text-decoration: none; color:white;">deconnexion </a> </button>
  <button  class="open-button " onclick="openForm2()">inscription</button>
</center>


<?php
    if(isset($_SESSION['id'])&&isset($_SESSION['pseudo'])){    
            ?>
    <script> //afficher le boutton connexion ou decnx.
       document.getElementById("cnx").style.display = "none";
       document.getElementById("dcnx").style.display = "inline-block";
     </script>
    <?php
    }else{
      ?>
      <script> 
        document.getElementById("dcnx").style.display = "none";
       document.getElementById("cnx").style.display = "inline-block";
       </script>
      <?php
    }
    ?>
<div class="messageErreur">
										<?php
											if(isset($_GET['erreur'])) if ($_GET['erreur']) echo '<p>* vous devriez se connecter d abord </p>';
										?>
		</div>
<?php
$this->demande_devis();
?>
</div>
<?php
}

public function contenu(){
  ?>
  <div class="contenuglb">
  <?php
  $this->afficher_articles();
   $this->partie_droite();
   ?>
   </div>
   <?php
}
public function footer() {
    ?>   
<footer>


    <ul id="footer" >
            <hr>
            <li><a href="#home"style="margin-right: 200px;">a propos</a></li>
            <li><a href="#news">blog</a></li>
            <li><a href="recrutement.php">recrutement</a></li>
            <li><a href="#news">traduction</a></li>
            <li><a href="./liste_traducteur.php">traducteurs</a></li>
            <li><a href="index.php">Acceuil</a></li>
            <img  src="" alt="">              
    </ul>   
</footer>
</body>
</html>
    <?php
}

public function profil_client() {
  

  if(isset($_SESSION['id'])&&isset($_SESSION['pseudo'])){
       
    $c=new modele();
    $con=$c->connexion("localhost","root","","projet");
    //pour remplir les données de formulaire de modification
     $infos=$con->prepare('SELECT * FROM client WHERE pseudo = ? ');
      $infos->execute(array($_SESSION['pseudo']));
      $resultat=$infos->fetch();
     //recuperer les donnees de la bdd client
    $nom=$resultat['nom'];
    $prenom = $resultat['prenom'];
    $date = $resultat['date'];
    $adresse = $resultat['adresse'];
    $email = $resultat['email'];
    $pseudo = $resultat['pseudo'];
    $password = $resultat['password'];
  }    

   //pour remplir les données de tableau d'historique 
   $infos2=$con->prepare('SELECT * FROM devis WHERE idclient = ? ');
   $infos2->execute(array($_SESSION['id']));
   
   
    $this->entete();
    $this->headbar();
    $this->menu();
    ?> 
    
    <div class="contenuglb">
    <h3 style="margin-bottom:20px ;">HELLO <?php echo  $pseudo ?> 🤗 </h3>
<div class="infosClient">                
    <form method="post" action="modif.php"   >
  
    <fieldset class="rubrique" >
        <legend> <h3>  Modifier vos informations : </h3></legend>
     
    <label> Nom : </label>                  
        <input type="text" name="nom"  placeholder="<?php echo $nom ?>" /><br/>   
    
    <label>  Prénom :</label>              
        <input type="text" id="prenom"  name="prenom" placeholder="<?php echo $prenom ?>" /><br/>    
    
    <label>  Date naissance : </label> 
        <input type="date" name="dateN"/><br/>
       
    <label style="display:inline-block;">  Sexe : </label> 
        <select name="sexe" style="display:inline-block;"> 
        <option value="Femme"> Femme </option>
        <option value="Homme"> Homme</option>    
        </select>   

    <label>   Adresse : </label> 
        <input type="text" name="adresse" placeholder="<?php echo $adresse ?>"/><br/>
        
    <label>  Mail : </label>
        <input type="text" name="email" placeholder="<?php echo $email ?>" /><br/>
    
     <label> Pseudonyme : </label>
        <input type="text" name="pseudo" placeholder="<?php echo $pseudo ?>" /><br/>
    
    <label>  Changer le mot de passe : </label>
        <input type="password" name="mot_passe1" placeholder="votre mot de passe"/><br/>
        <input type="password" name="mot_passe2" style="margin-left:235px;" placeholder="nouveau mot de passe"/><br/>
        <center><input type="submit" class="envoyer" value="Enregistrer les modifications"/></center>
</fieldset>
</form>
</div> 
 <div class="historique ">
   <h3>historique des demandes de devis</h3> <br>
   <table>
   <tr>
    <th>Date</th>
    <th>type de traduction</th>
    <th>langue source</th>
    <th>langue origine</th>
  </tr>
  
  <?php 
   //recuperer les donnees de la bdd devis
   while ($val = $infos2->fetch()) 
	{
    ?> <tr> <?php
    $type=$val['typetraduction'];
    $source = $val['langsource'];
    $origine = $val['langvolu'];
    $d=$val['dateD'];
    ?><td><?php echo $d ?></td><?php
    ?><td><?php echo $type ?></td><?php
    ?><td><?php echo $source ?></td><?php
    ?><td><?php echo $origine ?></td><?php
    ?></tr><?php
	}
  ?>
   </table>
 </div> 
 </div>
  <?php
    $this->footer();
}

public function recrutement() {
  
  $this->entete();
  $this->headbar();
  $this->menu();
  ?> 
 <center>
 <div class="form" style="margin:5%; width:700px ; max-height: 100%;" >
    <form action="recrutement_form.php" method="post"  enctype="multipart/form-data">
      <center><label style="font-size: 25px">recrutement des traducteurs</label></center>
      <label style="float:left;">  Nom* : </label>
      <input type="text" placeholder="Enter votre nom" name="nom" style="inline:block" required>
      <label style="float:left">  Prenom* : </label><br>
      <input type="text" placeholder="Enter votre prénom" name="prenom"  required>
      <label style="float:left">  E-mail* : </label><br>
      <input type="text" placeholder="Enter votre adresse email" name="email" required>
      <label style="float:left">  Telephone* : </label><br>
      <input type="text" placeholder="Enter votre numéro de telephone" name="tel"  required><br>
      <label style="float:left">  Date de naissance* : </label><br><br>
        <input type="date" name="dateN" style="float:left" required="required"/><br> <br>  
        <label style="float:left">  Sexe* : </label><br><br>
         <select name="sexe" style="width:300px; background-color:white;float:left"> 
        <option value="Femme"> Femme </option>
        <option value="Homme"> Homme</option>    
        </select>  <br><br>
        <label style="float:left">  Adresse* : </label><br>
        <input type="text" name="adresse" placeholder="Enter votre adresse" required="required" /><br>
        <label style="float:left">  Pseudo* : </label><br>
        <input type="text" name="pseudo" placeholder="Enter un psodonyme" required="required" /><br>
           
      <label for="language">Type de traduction*</label>
      <select name="type" id="disabledSelect" class="form-control"  required>
        <option value="scientifique">scientifique</option>
        <option value="général">general</option>
        <option value="siteweb">site web</option>
      </select>

      <label for="language">langue de traduction*</label>
      <select name="langue" id="disabledSelect" class="form-control"  required>
        <option value="arabe">arabe</option>
        <option value="anglais">english</option>
        <option value="francais">francais</option>
        </select>
      <label style="float:left">attacher votre cv:</label> <br><br>
      <div id="file" style="float:left">
      <input  type="file" name="myfile" required/> <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/> <br>
      </div> 
      <input id="add" type="button" value="+" style=" border-radius: 50% ;font-size:15px;margin:5px;cursor: pointer; border: none;color: white;text-align: center;
  text-decoration: none;  background-color:gray;" >ajouter une reference</input><br><br>

      <input  type="checkbox" id="assure"   >assurmentation</input> <br><br>
      <input id="b" type="file" name="nomduchamp" style="display:none" /> <br> <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/> 
      <label style="float:left">  le mot de passe* : </label>
      <input type="password" name="mot_passe1" style="float:left" required="required" /><br><br>
        <label style="float:left">  Retaper le mot de passe* : </label>
        <input type="password" name="mot_passe2" style="float:left"  required="required" /><br><br>
      <label for="comment" style="float:left">Votre Message</label><br>
      <textarea name="msg" class="form-control" rows="30" id="comment" placeholder="Message" ></textarea><br>

      
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
  </center>
  <script>
  $("#assure").click(function(){
    if ($('#b').css('display')=='none'){
  $('#b').css('display','block');}else{
    $('#b').css('display','none');
  }
});

$(document).ready(function(){
  var i = 0;
  $("#add").click(function(){
    $(this).html(i++);
    if (i<=2){
    var file= $("<input></input>").attr({type: 'file', name: 'myfile'}).css({"display": "block"});
    $("#file").prepend(file);

  }
  });
  
});
  </script>
<?php

$this->footer();
}


public function profil_traducteur() {
  

  if(isset($_SESSION['id'])&&isset($_SESSION['pseudo'])){
       
    $c=new modele();
    $con=$c->connexion("localhost","root","","projet");
    //pour remplir les données de formulaire de modification
     $infos=$con->prepare('SELECT * FROM client WHERE pseudo = ? ');
      $infos->execute(array($_SESSION['pseudo']));
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
  }    

   //pour remplir les données de tableau d'historique 
   $infos2=$con->prepare('SELECT * FROM devis WHERE idclient = ? ');
   $infos2->execute(array($_SESSION['id']));
   
   
    $this->entete();
    $this->headbar();
    $this->menu();
    ?> 
    <div class="contenuglb">
<div class="infosClient">                
    <form method="post" action="modif.php"   >
  
    <fieldset class="rubrique" >
        <legend> <h2>  Modification des infos : </h2></legend>
     
    <label> Nom : </label>                  
        <input type="text" name="nom"  placeholder="<?php echo $nom ?>" /><br/>   
    
    <label>  Prénom :</label>              
        <input type="text" id="prenom"  name="prenom" placeholder="<?php echo $prenom ?>" /><br/>    
    
    <label>  Date naissance : </label> 
        <input type="date" name="dateN"/><br/>
       
    <label style="display:inline-block;">  Sexe : </label> 
        <select name="sexe" style="display:inline-block;"> 
        <option value="Femme"> Femme </option>
        <option value="Homme"> Homme</option>    
        </select>   

    <label>   Adresse : </label> 
        <input type="text" name="adresse" placeholder="<?php echo $adresse ?>"/><br/>
        
    <label>  Mail : </label>
        <input type="text" name="email" placeholder="<?php echo $email ?>" /><br/>
    
     <label> Pseudonyme : </label>
        <input type="text" name="pseudo" placeholder="<?php echo $pseudo ?>" /><br/>
    
    <label>  Changer le mot de passe : </label>
        <input type="password" name="mot_passe1" placeholder="votre mot de passe"/><br/>
        <input type="password" name="mot_passe2" style="margin-left:235px;" placeholder="nouveau mot de passe"/><br><br>
        <label>  attachez des nouvelles references : </label> <br>
        <div id="file2" style=" display : inline-block ;width : 100%">
      <input  type="file" name="myfile" />
      </div> 
      <input id="add2" type="button" value="+" style=" width : 25px "  >ajouter une reference</input><br><br>

      <input  type="checkbox" id="assure2" style=" margin : 0%"   >assurmentation</input> 
      <input id="b2" type="file" name="nomduchamp" style="display:none" /> <br>
        <center><input type="submit" class="envoyer" value="Enregistrer les modifications"/></center>

      

</fieldset>
</form>
</div> 
<script>
$("#assure2").click(function(){
    if ($('#b2').css('display')=='none'){
  $('#b2').css('display','block');}else{
    $('#b2').css('display','none');
  }
});

$(document).ready(function(){
  var i = 0;
  $("#add2").click(function(){
    $(this).html(i++);
    if (i<=2){
    var file= $("<input></input>").attr({type: 'file', name: 'myfile'});
    $("#file2").prepend(file);

  }
  });
  
});
  </script>
 <div class="historique ">
   <h2>historique des traductions</h2> <br>
   <table>
   <tr>
    <th>Date</th>
    <th>type de traduction</th>
    <th>langue source</th>
    <th>langue origine</th>
  </tr>
  
  <?php 
   //recuperer les donnees de la bdd devis
   
 //pour remplir les données de tableau d'historique 
 $infos2=$con->prepare('SELECT * FROM devis WHERE idtraducteur = ? ');
 $infos2->execute(array($id)); 
   while ($val = $infos2->fetch()) 
	{
    ?> <tr> <?php
    $type=$val['typetraduction'];
    $source = $val['langsource'];
    $origine = $val['langvolu'];
    $d=$val['dateD'];
    ?><td><?php echo $d ?></td><?php
    ?><td><?php echo $type ?></td><?php
    ?><td><?php echo $source ?></td><?php
    ?><td><?php echo $origine ?></td><?php
    ?></tr><?php
	}
  ?>
   </table>
 </div> 
 </div>
  <?php
    $this->footer();
}



public function liste_traducteur(){
  $this->entete();
  $this->headbar();
  $this->menu();
    
  
    $c=new modele();
    $con=$c->connexion("localhost","root","","projet");
    //pour remplir les données de formulaire de modification
    ?>
    <div class="card-deck"  style="padding:5% 0% ;display : block ;width : 100%">
    <?php
    
    $infos=$con->prepare('SELECT * FROM client WHERE traducteur = TRUE ');
    $infos->execute();
    $i=0;

    while ( $resultat=$infos->fetch()){
     //recuperer les donnees de la bdd client
     $i++;
    $nom=$resultat['nom'];
    $prenom = $resultat['prenom'];
    $date = $resultat['date'];
    $adresse = $resultat['adresse'];
    $email = $resultat['email'];
    $pseudo = $resultat['pseudo'];
    $password = $resultat['password'];
    $lang = $resultat['langue'];
    $type = $resultat['typetrd'];

  
?>

  <div class="card" style="width : 22% ; display : inline-block ;">
    <img class="card-img-top" src="image/user.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><a href=""><?php echo $nom." ".$prenom;?></a></h5>
      <p class="card-text"><?php echo " Date de naissance :".$date;?><br><?php echo " E-mail :". $email;?><br><?php echo " Adresse :". $adresse;?><br><?php echo "langues de traduction :".$lang;?><br><?php echo "type de traduction :".$type;?><br></p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
 <?php
  if ($i==4){
    
    ?> 
    </div>
    <div class="card-deck"  style="padding:5% 0% ;display : block">
    <?php ;
  }
 }
 
 $this->footer();
}


public function traduction(){
  $this->entete();
  $this->headbar();
  $this->menu();
  ?>
  <div style=" display : block ; padding:20px">
  <h3>Traduction scientifique</h3> 
  <img src="image/i1.jpg" alt="" style="display : block ; width:30% ; "> <br>
  <p>Cultures Connection a acquis une expérience prouvée dans le domaine de la traduction scientifique et technique,  
  notamment sur les sujets suivants: biotechnologies, manipulations d’ADN, physiologie moléculaire, biologie, zoologie, botanique,
   géologie, biodiversité, biomédicale, médicale, environnement, développement durable,
   alimentation, santé, virologie, médecine, bioingénierie, énergies renouvelables, relations hôte/pathogène, etc.</p>
  </div>
  <div style=" display : block ; padding:20px">
  <h3>Traduction generale</h3> 
  <img src="image/i2.jpg" alt="" style="display : block ; width:30% ; "> <br>
  <p>Cultures Connection a acquis une expérience prouvée dans le domaine de la traduction scientifique et technique,  
  notamment sur les sujets suivants: biotechnologies, manipulations d’ADN, physiologie moléculaire, biologie, zoologie, botanique,
   géologie, biodiversité, biomédicale, médicale, environnement, développement durable,
   alimentation, santé, virologie, médecine, bioingénierie, énergies renouvelables, relations hôte/pathogène, etc.</p>
  </div>
  <div style=" display : block ; padding:20px">
  <h3>Traduction des sites web</h3> 
  <img src="image/i3.jpg" alt="" style="display : block ; width:30% ; "> <br>
  <p>Cultures Connection a acquis une expérience prouvée dans le domaine de la traduction scientifique et technique,  
  notamment sur les sujets suivants: biotechnologies, manipulations d’ADN, physiologie moléculaire, biologie, zoologie, botanique,
   géologie, biodiversité, biomédicale, médicale, environnement, développement durable,
   alimentation, santé, virologie, médecine, bioingénierie, énergies renouvelables, relations hôte/pathogène, etc.</p>
  </div>
  <?php
  $this->footer();
}


public function afficher_site() {
   
  
    $this->entete();
    if(isset($_GET['demande'])) if ($_GET['demande']) {
     
      $this->choisir_traducteur();
      }
    $this->headbar();
    
    $this->menu();
   $this->connexion();
    $this->inscription();
    
    $this->slideshow();
   
    $this->contenu();
   
    $this->footer();

    
}

}
?>