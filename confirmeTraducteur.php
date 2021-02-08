<?php 
	include_once('controller.php');
    $c=new controller();
    $ps=$_GET['pseudo'];
	$c->confirme_traducteur($ps);