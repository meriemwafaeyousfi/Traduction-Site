<?php 
include_once('controller.php');
$c=new controller();
$ps=$_GET['devis'];
$c->valider_prix($ps);