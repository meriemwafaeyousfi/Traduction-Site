<?php 
	include_once('admin.php');
    $c=new admin();
    $ps=$_GET['pseudo'];
   
   $mod=new modele();
   $con=$mod->connexion("localhost","root","","projet");
    $infos=$con->prepare("SELECT * FROM client WHERE pseudo='$ps'");
   $infos->execute();
  $resultat=$infos->fetch();
  $tra=$resultat['traducteur'];
  if ($ps!="non"){

  if($tra==TRUE){
    $c->consulter_traducteur($ps);
         
  }else{
    $c->consulter_client($ps);
         
  }
}else { header("Location:tabDevis.php");}