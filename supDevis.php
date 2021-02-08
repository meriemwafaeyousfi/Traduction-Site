<?php 
    include_once('controller.php');
    include_once('modele.php');

    $c=new controller();
    $id=$_GET['id'];
       

    $c->sup_devis($id);
 
