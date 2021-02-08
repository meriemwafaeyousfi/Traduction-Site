<?php 
	include_once('controller.php');
    $c=new controller();
    $ps=$_GET['pseudo'];
    $bloc=$_GET['bloc'];
    
         
   $mod=new modele();
   $con=$mod->connexion("localhost","root","","projet");
    $infos=$con->prepare("SELECT * FROM client WHERE pseudo='$ps'");
   $infos->execute();
  $resultat=$infos->fetch();
  $tra=$resultat['traducteur'];
  if($tra==TRUE){
    $c->block_traducteur($ps,$bloc);
  }else{
    $c->block_client($ps,$bloc);
  }