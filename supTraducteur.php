<?php 
    include_once('controller.php');
    include_once('modele.php');

    $c=new controller();
    $ps=$_GET['pseudo'];
       
   $mod=new modele();
   $con=$mod->connexion("localhost","root","","projet");
    $infos=$con->prepare("SELECT * FROM client WHERE pseudo='$ps'");
   $infos->execute();
  $resultat=$infos->fetch();
  $tra=$resultat['traducteur'];
  if($tra==TRUE){
    $c->sup_traducteur($ps);
  }else{
    $c->sup_client($ps);
  }
