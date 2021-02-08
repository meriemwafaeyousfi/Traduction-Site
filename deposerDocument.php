<?php 
	include_once('controller.php');
    $c=new controller();
    $ps=$_GET['devis'];
    $c->deposer_document($ps);