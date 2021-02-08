<?php 
include_once('controller.php');
$c=new controller();
$ps=$_GET['devis'];
$c->choisir_prix($ps);