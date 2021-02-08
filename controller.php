<?php
require_once('vue.php');
require_once('modele.php');
include_once("utilisateur.php");
include_once("dmddevis.php");
Class controller{

function afficher_site(){
$c=new accueil();
$c->afficher_site();
}

/*************************inscription**********************/
public function inscription_form(){
    //Connection à la base de données
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    
    /**Vérification de l'adresse e-mail et du pseudo**/
    //Les requêtes de lecture
    $verifEmail=$bdd->prepare('SELECT * FROM client WHERE  email=?');
    $verifEmail->execute(array($_POST['email']));
    $verifPseudo=$bdd->prepare('SELECT * FROM client WHERE pseudo=?');
    $verifPseudo->execute(array($_POST['pseudo']));
    $verifEmailRes=$verifEmail->fetch();
    $verifPseudoRes=$verifPseudo->fetch();
    $emailExist=false;
    $pseudoExist=false;
    if($verifEmailRes['id']){
        $emailExist=true;
    }
    if($verifPseudoRes['id']){
        $pseudoExist=true;
    }

    //Vérification du mot de passe
    $passeErone=false;
    if($_POST['mot_passe1']!=$_POST['mot_passe2']){
        $passeErone=true;
    }
    //Si le pseudo ou l'email existe dèja
    if($pseudoExist||$emailExist||$passeErone){
        //redirection vers la page d'inscription
        header('Location:./404.php?email='.$emailExist.'&'.'pseudo='.$pseudoExist.'&'.'password='.$passeErone);
    }
    
    /**Ajout de l'utilisateur dans la base de données**/				
    //Si le pseudo et l'email n'existe pas  alors on ajoute l'utilisateur à la base de données
    
    else{
        //création d'un nouveau user 
        $user = new utilisateur($_POST['nom'],$_POST['prenom'],$_POST['dateN'],$_POST['sexe'],$_POST['adresse'],
                                      $_POST['pseudo'],$_POST['mot_passe1'],$_POST['email'],"");
        
        //La reqêtte d'ajout dans la table des users
        $ajoutUserP=$bdd->prepare('INSERT INTO client (nom, prenom,date, sexe, adresse, pseudo,email,password) VALUES (?,?,?,?,?,?,?,?)');
        $ajoutUserP->execute(array($user->getNom(),$user->getPrenom(),$user->getDateNaissance(),$user->getSexe(),
        $user->getAdresse(),$user->getPseudo(),$user->getEmail(),$user->getPasse()));
        $ajoutUserP->closeCursor();
        
        header('Location:./index.php');
     
        //Redirection vers la page de Login

}
}
/**********s'authentifier********************** */
public function authentification(){
    $m= new modele();
$bdd =$m->connexion("localhost","root","","projet");
//hachage du mot de passe
$pass_hash=sha1($_POST['mot_pass']);
//Connection à la base de données
$conn=$bdd->prepare('SELECT * FROM client WHERE pseudo = ? AND password=? ');
$conn->execute(array($_POST['pseudo2'],$pass_hash));
//echo ("pseudo  ".$nom." mot de passe ".$pass_hash." ") ;
//$count = $conn->rowCount(); 
$resultat=$conn->fetch();

if(!$resultat['pseudo']){
    header('Location:index.php?erreurcnx=1');
}
else{	
    
    $_SESSION['id']=$resultat['id'];
    $_SESSION['pseudo']=$resultat['pseudo'];
  
    if($resultat['traducteur']==TRUE)	{
        header('Location:profiltraducteur.php');
    }else{
    header('Location:profilclient.php');
}


}
}
/************************************demander un devis************************* */
public function demander_devis(){
 $m= new modele();

     
$bdd =$m->connexion("localhost","root","","projet");
if(isset($_SESSION['id'])&&isset($_SESSION['pseudo'])){ /*verifier si une session n'est deja ouverte*/
     $idclient=$_SESSION['id'];
    $dmd = new dmddevis($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['tel'],$_POST['type'],
    $_POST['source'],$_POST['langue'],$_POST['msg']);
    $dd = new DateTime("0000-00-00 00:00:00", new DateTimeZone('America/New_York'));
     $dd->format('Y-m-d h:i:s');
     $timestamp     =     strftime("%Y-%m-%d %H:%M:%S %Y");
//La reqêtte d'ajout dans la table des users
$ajoutDmd=$bdd->prepare('INSERT INTO devis (nomc, prenomc,emailc,telc,typetraduction,langsource,langvolu,message,idclient,dateD,idtraducteur) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
$ajoutDmd->execute(array($dmd->getNom(),$dmd->getPrenom(),$dmd->getMail(),$dmd->getTel(),
$dmd->getType(),$dmd->getSource(),$dmd->getLangue(),$dmd->getMsg(),$idclient,strftime("%Y-%m-%d %H:%M:%S", strtotime($timestamp)),0));

$mid = $bdd->lastInsertId() ;
//$ajoutDmd->closeCursor();
  header('Location:index.php?demande=1 & langue='.$dmd->getLangue().'&'.'type='.$dmd->getType().'&'.'iddevis='.$mid);

  


}else{
    echo "vous devriez se connecter d'abord";  
    header('Location:index.php?erreur=1');
}

}

/********************************modifier le profil de client************************** */
public function modificationProfil(){

     
    if(isset($_SESSION['id'])&&isset($_SESSION['pseudo'])){
        $m= new modele();
        $bdd =$m->connexion("localhost","root","","projet");
        
   $verifEmail=$bdd->prepare('SELECT * FROM client WHERE  email=?');
    $verifEmail->execute(array($_POST['email']));
    $verifPseudo=$bdd->prepare('SELECT * FROM client WHERE pseudo=?');
    $verifPseudo->execute(array($_SESSION['pseudo']));
    $verifEmailRes=$verifEmail->fetch();
    $verifPseudoRes=$verifPseudo->fetch();
    $nom=$verifPseudoRes['nom'];
        $prenom = $verifPseudoRes['prenom'];
        $date = $verifPseudoRes['date'];
        $adresse = $verifPseudoRes['adresse'];
        $email = $verifPseudoRes['email'];
        $pseudo = $verifPseudoRes['pseudo'];
        $password = $verifPseudoRes['password'];
    
    $verif=$bdd->prepare('SELECT * FROM client WHERE pseudo=?');
    $verif->execute(array($_POST['pseudo']));   
    $number = $verif->fetchColumn();
    
        /**********recuperer les données qui existe deja en base de donnees******** */
        
      

    $emailExist=false;
    $pseudoExist=false;
   if($verifEmailRes['id']){
        $emailExist=true;
        echo"mail";
        
    }
   if($number>1){
        $pseudoExist=true;
        echo"$number";
    }

    //Vérification du mot de passe
    $passeErone=false;
    if((sha1($_POST['mot_passe1'])!=$password && $_POST['mot_passe1']!="")){
        $passeErone=true;
        echo"psseword";
    }
    //Si le pseudo ou l'email existe dèja
    if($emailExist||$passeErone||$pseudoExist){
        //redirection vers la page d'inscription
        header('Location:./404.php?email='.$emailExist.'&'.'pseudo='.$pseudoExist.'&'.'password='.$passeErone);
       // header('Location:./index.php?email='.$emailExist.'&'.'password='.$passeErone);
    }
    
    /**Ajout de l'utilisateur dans la base de données**/				  
    else{
        
      
        //verifier si tous les champs sont remplits
       if("" !== trim($_POST['nom'])){
        $nom =$_POST['nom'];
        }
        if("" !== trim($_POST['prenom'])){
            $prenom =$_POST['prenom'];
            }
        if("" !== trim($_POST['dateN'])){
            $date =$_POST['dateN'];
                }
         if("" !== trim($_POST['adresse'])){
            $adresse =$_POST['adresse'];
                        }
        if("" !== trim($_POST['email'])){
            $email =$_POST['email'];
             }
        if("" !== trim($_POST['pseudo'])){
        $pseudo =$_POST['pseudo'];
                   }
      if("" !== trim($_POST['mot_passe1'])){
        $password =sha1($_POST['mot_passe2']);
      echo" $password ";
                               }
          
        //création d'un nouveau user 
        $user = new utilisateur($nom,$prenom,$date,$_POST['sexe'],$adresse,
                                      $pseudo,$password,$email,"");
                                                                
         $modif=$bdd->prepare(' UPDATE client SET nom=?, prenom=?, date=?, sexe=?, adresse=?, pseudo=?,email=?,password=? WHERE pseudo=?');
         $modif->execute(array($user->getNom(),$user->getPrenom(),$user->getDateNaissance(),$user->getSexe(),
         $user->getAdresse(),$user->getPseudo(),$user->getEmail(),$password,$_SESSION['pseudo']));  
       header('Location: index.php');
       }
    }else{
        echo"connecter vous";
    }
        
}


/********************************recrutement************************** */
public function recrutement(){

    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");


    if( isset($_POST['submit']) ) // si formulaire soumis
{
    $verifEmail=$bdd->prepare('SELECT * FROM client WHERE  email=?');
    $verifEmail->execute(array($_POST['email']));
    $verifPseudo=$bdd->prepare('SELECT * FROM client WHERE pseudo=?');
    $verifPseudo->execute(array($_POST['pseudo']));
    $verifEmailRes=$verifEmail->fetch();
    $verifPseudoRes=$verifPseudo->fetch();
    $emailExist=false;
    $pseudoExist=false;
    if($verifEmailRes['id']){
        $emailExist=true;
    }
    if($verifPseudoRes['id']){
        $pseudoExist=true;
    }

    //Vérification du mot de passe
    $passeErone=false;
    if($_POST['mot_passe1']!=$_POST['mot_passe2']){
        $passeErone=true;
    }
    //Si le pseudo ou l'email existe dèja
    if($pseudoExist||$emailExist||$passeErone){
        //redirection vers la page d'inscription
        header('Location:./404.php?email='.$emailExist.'&'.'pseudo='.$pseudoExist.'&'.'password='.$passeErone);
    }else{ 
    $uploads_dir = 'C:/wamp64/www/tdw/upload/CV';
    $name = $_FILES['myfile']['name'];
    $tmp_name = $_FILES["myfile"]["tmp_name"];
    $target_file = $uploads_dir . basename($_FILES["myfile"]["name"]); 
    $ext=pathinfo($target_file ,PATHINFO_EXTENSION);

    if($ext!="pdf"){
 echo "fichier n'est pas pdf";
    }else{
        $user = new utilisateur($_POST['nom'],$_POST['prenom'],$_POST['dateN'],$_POST['sexe'],$_POST['adresse'],
                                      $_POST['pseudo'],$_POST['mot_passe1'],$_POST['email'],TRUE);
        
        //La reqêtte d'ajout dans la table des users

    $query = $bdd->prepare('INSERT INTO client (nom, prenom,date, sexe, adresse, pseudo,email,traducteur,password,cv1,langue,typetrd) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
    $query->execute(array($user->getNom(),$user->getPrenom(),$user->getDateNaissance(),$user->getSexe(),
    $user->getAdresse(),$user->getPseudo(),$user->getEmail(),$user->getBool(),$user->getPasse(),$name,$_POST['langue'],$_POST['type']));
    move_uploaded_file($tmp_name, "$uploads_dir/cv_".$_POST['pseudo'].".".$ext);


	/*UPDATE document SET   document.piece_jointe ='$name_file' WHERE document.doc_titre = '$v_titre*/	
    header('Location:index.php');
    }

   }
}
else{    header('Location:index.php?erreur=1');}
}
public function choisir_traducteur(){
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    $verifEmail=$bdd->prepare('SELECT * FROM client WHERE  pseudo=?');
   // echo $_POST['radio'];
    $verifEmail->execute(array($_POST['radio']));
    $Res=$verifEmail->fetch();
   
   $l=$_POST['hidden'];
    $a=$bdd->prepare("UPDATE devis SET idtraducteur=? WHERE iddevis= '$l'");
    $a->execute(array($Res['id']));
    $a2=$bdd->prepare("INSERT notifications(idcl,idtr,idevis) VALUES (?,?,?)");
    $a2->execute(array($_SESSION['id'],$Res['id'],$l));
    header('Location:index.php');
}


public function choisir_prix($devis){
  $m= new modele();
  $bdd =$m->connexion("localhost","root","","projet");
  $sql=$bdd->prepare("UPDATE devis SET prix=? WHERE iddevis ='$devis' ");
  $sql->execute(array($_POST['prix']));
    $sql2=$bdd->prepare("UPDATE notifications SET con=TRUE WHERE idevis ='$devis' ");
    $sql2->execute();
    
    header('Location:notif.php');
}
public function deposer_document($devis){
  $m= new modele();
  $bdd =$m->connexion("localhost","root","","projet");
  $sql1=$bdd->prepare("UPDATE devis SET doctraduit=?, statusD=? WHERE iddevis ='$devis' ");
   $sql1->execute(array('upload/document/doc.pdf',2)); 
   $sql1=$bdd->prepare("UPDATE notifications SET doc=TRUE WHERE idevis ='$devis' ");
   $sql1->execute(array('upload/document/doc.pdf')); 
    header('Location:noti.php');
}

public function valider_prix($devis){
  $m= new modele();
  $bdd =$m->connexion("localhost","root","","projet");
  $sql1=$bdd->prepare("UPDATE devis SET payement=TRUE WHERE iddevis ='$devis' ");
   $sql1->execute();
   $sql1=$bdd->prepare("UPDATE notifications SET payreq=TRUE WHERE idevis ='$devis' ");
   $sql1->execute();
   
    
    header('Location:notif2.php');
}

public function confirme_prix($devis){
  $m= new modele();
  $bdd =$m->connexion("localhost","root","","projet");
  $sql=$bdd->prepare("SELECT * FROM devis WHERE  iddevis='$devis'");
  $sql->execute();
  $Res=$sql->fetch();
  if($Res['payement']) {
    $sql1=$bdd->prepare("UPDATE devis SET conf=TRUE , statusD=1  WHERE iddevis ='$devis' ");
   $sql1->execute();
   $sql2=$bdd->prepare("UPDATE notifications SET pay=TRUE WHERE idevis ='$devis' ");
   $sql2->execute();
    header('Location:tabDevis.php');

  }else{
    header('Location:tabDevis.php?erreur=le client na pas confirmer le payement');
  }
  
}
/*********************************************admin controllers******** */
public function sup_traducteur($user){
   
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    $sql=$bdd->prepare("DELETE FROM client WHERE pseudo ='$user' ");
    $sql->execute();
    header('Location:catTraducteur.php');
}
public function sup_client($user){
   
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    $sql=$bdd->prepare("DELETE FROM client WHERE pseudo ='$user' ");
    $sql->execute();
    header('Location:catClient.php');
}
public function sup_devis($id){
   
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    $sql=$bdd->prepare("DELETE FROM devis WHERE iddevis ='$id' ");
    $sql->execute();
    header('Location:tabDevis.php');
}
public function block_traducteur($user,$bloc){
   
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    if ($bloc==FALSE){
    $sql=$bdd->prepare("UPDATE client SET blocked=TRUE WHERE pseudo='$user' ");
    $sql->execute();
    }else{
        $sql=$bdd->prepare("UPDATE client SET blocked=FALSE WHERE pseudo='$user' ");
        $sql->execute();   
    }
    header('Location:catTraducteur.php');
}
public function block_client($user,$bloc){
   
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    if ($bloc==FALSE){
    $sql=$bdd->prepare("UPDATE client SET blocked=TRUE WHERE pseudo='$user' ");
    $sql->execute();
    }else{
        $sql=$bdd->prepare("UPDATE client SET blocked=FALSE WHERE pseudo='$user' ");
        $sql->execute();   
    }
    header('Location:catClient.php');
}

public function confirme_traducteur($user){
   
    $m= new modele();
    $bdd =$m->connexion("localhost","root","","projet");
    $sql=$bdd->prepare("UPDATE client SET confirmed=TRUE WHERE pseudo ='$user' ");
    $sql->execute();
    header('Location:catTraducteur.php');
}

/******************************************tableau de bord********************************************* */
/*********************************j'ai utilisé de html ici il faut le faire dans la vue apres***** */
public function bordtab(){
$date1=$_POST["date1"];
$date2=$_POST["date2"];
//$date1=$date1." 00:00:00";
//$date2=$date2." 00:00:00";

$number=0;

$date1 = date("Y-m-d H:i:s",strtotime($date1));
$date2 = date("Y-m-d H:i:s",strtotime($date2));
$m= new modele();
$bdd =$m->connexion("localhost","root","","projet");
$sql=$bdd->prepare("SELECT * FROM devis WHERE dateD <= '$date2' AND dateD >= '$date1' ");
$sql->execute();
$number=$sql->rowCount();
//echo $number;
if($number==0){
    echo"enter a valid date or devis does not existe in this intervalle";
}
//else echo"<h3>nombre devis entre ces deux date est '$number'</h3>";
//$result = $sql->fetchAll();/********tout les traduction***** */

for($i=0;$i<$number;$i++){
    $result = $sql->fetch();
    $traducteur=$result['idtraducteur'];
    $client=$result['idclient'];
    //echo "hhhh".$traducteur;
    $sql2=$bdd->prepare("SELECT * FROM devis WHERE dateD <= '$date2' AND dateD >= '$date1'  AND idtraducteur='$traducteur'  AND payement = TRUE ");
    $sql2->execute();
    $number2=$sql2->rowCount();
    $s=$bdd->prepare("SELECT * FROM devis WHERE dateD <= '$date2' AND dateD >= '$date1'  AND idclient='$client'  AND payement = TRUE ");
    $s->execute();
    $n=$s->rowCount();
    //echo "hoho".$number2;
    $sql3=$bdd->prepare("SELECT * FROM client WHERE  id='$traducteur' ");
    $sql3->execute();
    $result3 = $sql3->fetch();
    $nom=$result3['pseudo'];
    $s2=$bdd->prepare("SELECT * FROM client WHERE  id='$client' ");
    $s2->execute();
    $r = $s2->fetch();
    $name=$r['pseudo'];
    //echo "hhh".$nom;
    $sql5=$bdd->prepare("SELECT * FROM traducteur WHERE nomtraducteur='$nom'" );
    $sql5->execute();
    $number3=0;
    $number3=$sql5->rowCount();
    if($number3==0 and $number2!=0 ){
    $sql4=$bdd->prepare("INSERT INTO traducteur (nomtraducteur,nbrtraduction) VALUES (?,?) ");
    $sql4->execute(array($nom,$number2));
    }
    $s3=$bdd->prepare("SELECT * FROM users WHERE nameclient='$name'" );
    $s3->execute();
    $n3=0;
    $n3=$s3->rowCount();
    if($n3==0 and $n!=0){
    $s4=$bdd->prepare("INSERT INTO users (nameclient,nbr) VALUES (?,?) ");
    $s4->execute(array($name,$n));
    }
    

}
$sql=$bdd->prepare("SELECT * FROM devis WHERE dateD <= '$date2' AND dateD >= '$date1' ");
$sql->execute();
for($i=0;$i<$number;$i++){
    $result = $sql->fetch();
    $traducteur=$result['idtraducteur'];
    $client=$result['idclient'];
   // echo "hhhh".$traducteur;
    $sql2=$bdd->prepare("SELECT * FROM devis WHERE dateD <= '$date2' AND dateD >= '$date1'  AND idtraducteur='$traducteur'   ");
    $sql2->execute();
    $number2=$sql2->rowCount();
    $s=$bdd->prepare("SELECT * FROM devis WHERE dateD <= '$date2' AND dateD >= '$date1'  AND idclient='$client'   ");
    $s->execute();
    $n=$s->rowCount();
    //echo "hoho".$number2;
    $sql3=$bdd->prepare("SELECT * FROM client WHERE  id='$traducteur' ");
    $sql3->execute();
    $result3 = $sql3->fetch();
    $nom=$result3['pseudo'];
    $s2=$bdd->prepare("SELECT * FROM client WHERE  id='$client' ");
    $s2->execute();
    $r = $s2->fetch();
    $name=$r['pseudo'];
    //echo "hhh".$nom;
    $sql5=$bdd->prepare("SELECT * FROM traducteurdmd WHERE nomdmd='$nom'" );
    $sql5->execute();
    $number3=0;
    $number3=$sql5->rowCount();
    if($number3==0 and $number2!=0 ){
    $sql4=$bdd->prepare("INSERT INTO traducteurdmd (nomdmd,nbrdmd) VALUES (?,?) ");
    $sql4->execute(array($nom,$number2));
    }
    $s3=$bdd->prepare("SELECT * FROM usersdmd WHERE nomuser='$name'" );
    $s3->execute();
    $n3=0;
    $n3=$s3->rowCount();
    if($n3==0 and $n!=0){
    $s4=$bdd->prepare("INSERT INTO usersdmd (nomuser,nbruser) VALUES (?,?) ");
    $s4->execute(array($name,$n));
    }
    

}

$sql6=$bdd->prepare("SELECT * FROM traducteur " );
    $sql6->execute();
    $json =[];
    $json2=[];
    $i=0; 
    ?>
    <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

</head>
<body style="padding : 5%">
<button style="float:right; padding : 10px"><a href="bord.php" style="text-decoration: none;font-size: 16px;"> 🏠 Acceuil</a></button> <br> <br>
<h3><?php echo "le nombre de devis effectuer dans cette periode est ".$number."  devis"; ?></h3> 
<div style="width :100% ;background-color: #e8e9f5;padding : 2% ">
<h3>nombre de traduction par traducteur et client dans cette periode</h3>
<table style="width : 45% ; display : inline ; margin-right:20%">

    <tr>
    <th>pseudo de traducteur</th>
    <th>nombre de traductions</th>
  </tr>

  <?php
    while($row=$sql6->fetch()){
      
          $json [$i]= $row['nomtraducteur'];
          $json2 [$i]= $row['nbrtraduction'];
          ?> <tr> <?php
          ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=". $json [$i]; ?>><?php echo  $json [$i]; ?></a></td><?php
          ?><td><?php echo $json2 [$i] ?></td><?php
          ?></tr><?php
       $i++;
    }
    ?>
    </table>
    
    <table style="width : 40% ;display : inline">
    <tr>
    <th>pseudo de client</th>
    <th>nombre de devis</th>
  </tr>
    <?php 
$s6=$bdd->prepare("SELECT * FROM users " );
$s6->execute();
$j1 =[];
$j2 =[];
$i=0; 
while($row=$s6->fetch()){
  
      $j1 [$i]= $row['nameclient'];
      $j2 [$i]= $row['nbr'];
      ?> <tr> <?php
  
      ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=". $j1 [$i]; ?>><?php echo  $j1 [$i]; ?></a></td><?php
 
      ?><td><?php echo $j2 [$i] ?></td><?php
      ?></tr><?php
   $i++;
}
?>
</table>
</div>
<br><br>
<!--devis-->

<?php
$sl6=$bdd->prepare("SELECT * FROM traducteurdmd " );
$sl6->execute();
$js =[];
$js2=[];
$i=0; 
?>
<div style="width :100%;background-color: #e8e9f5;padding : 2% ">
<h3>nombre de devis par traducteur et client dans cette periode</h3>
<table style="width : 45% ; display : inline ; margin-right:20%">

    <tr>
    <th>pseudo de traducteur</th>
    <th>nombre de traductions</th>
  </tr>

  <?php
    while($row=$sl6->fetch()){
      
          $js [$i]= $row['nomdmd'];
          $js2 [$i]= $row['nbrdmd'];
          ?> <tr> <?php
          ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=". $js [$i]; ?>><?php echo  $js [$i]; ?></a></td><?php
          ?><td><?php echo $js2 [$i] ?></td><?php
          ?></tr><?php
       $i++;
    }
    ?>
    </table>
    
    <table style="width : 40% ;display : inline">
    <tr>
    <th>pseudo de client</th>
    <th>nombre de devis</th>
  </tr>
    <?php 
$sq6=$bdd->prepare("SELECT * FROM usersdmd " );
$sq6->execute();
$jn =[];
$jn2 =[];
$i=0; 
while($row=$sq6->fetch()){
  
      $jn [$i]= $row['nomuser'];
      $jn2 [$i]= $row['nbruser'];
      ?> <tr> <?php
  
      ?><td><a href=<?php echo "consulterTraducteur.php?pseudo=". $jn [$i]; ?>><?php echo  $jn [$i]; ?></a></td><?php
 
      ?><td><?php echo $jn2 [$i] ?></td><?php
      ?></tr><?php
   $i++;
}
?>
</table>
</div>
<br><br>

<?php 


    

?>


    
<div class="chart-container" style="position: relative; height:20vh; width:40vw ; display:inline-block">
<canvas id="bar-chart"   ></canvas>
</div>
<div class="chart-container" style="position: relative; height:20vh; width:40vw ; display:inline-block">
<canvas id="bar-chart2"   ></canvas>
</div>
<div class="chart-container" style="position: relative; height:20vh; width:40vw ; display:inline-block ; margin-top :20%">
<canvas id="bar-chart3"   ></canvas>
</div>
<div class="chart-container" style="position: relative; height:20vh; width:40vw ; display:inline-block;margin-top :20%">
<canvas id="bar-chart4"   ></canvas>
</div>
<script>
  
  var jsArray = JSON.parse('<?php echo json_encode($json); ?>');
  var jsArray2 = JSON.parse('<?php echo json_encode($json2); ?>');
 

new Chart(document.getElementById("bar-chart"), {
   
    type: 'bar',
    data: {
      labels: jsArray,
      datasets: [
        {
          label: "nombre de traduction par traducteur",
          backgroundColor: "#3e95cd",
          data: jsArray2
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'nombre de traduction par traducteur'
      }
    }
});
var js = JSON.parse('<?php echo json_encode($j1); ?>');
  var js2 = JSON.parse('<?php echo json_encode($j2); ?>');
 
new Chart(document.getElementById("bar-chart2"), {
   
    
   type: 'bar',
   data: {
     labels: js,
     datasets: [
       {
         label: "nombre de devis par client",
         backgroundColor: "#3e95cd",
         data: js2
       }
     ]
   },
   options: {
     legend: { display: false },
     title: {
       display: true,
       text: 'nombre de devis par traducteur'
     }
   }
});
var j = JSON.parse('<?php echo json_encode($js); ?>');
  var j2 = JSON.parse('<?php echo json_encode($js2); ?>');
 
new Chart(document.getElementById("bar-chart3"), {
   
    
   type: 'bar',
   data: {
     labels: js,
     datasets: [
       {
         label: "nombre de devis par traducteur",
         backgroundColor: "#3e95cd",
         data: js2
       }
     ]
   },
   options: {
     legend: { display: false },
     title: {
       display: true,
       text: 'nombre de devis par client'
     }
   }
});

var js = JSON.parse('<?php echo json_encode($jn); ?>');
  var js2 = JSON.parse('<?php echo json_encode($jn2); ?>');
 
new Chart(document.getElementById("bar-chart4"), {
   
    
   type: 'bar',
   data: {
     labels: js,
     datasets: [
       {
         label: "nombre de devis par traducteur",
         backgroundColor: "#3e95cd",
         data: js2
       }
     ]
   },
   options: {
     legend: { display: false },
     title: {
       display: true,
       text: 'nombre de devis par traducteur'
     }
   }
});

</script>
</body>
</html>

<?php

}


}
?>