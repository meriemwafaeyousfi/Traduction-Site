<?php 
	include_once('controller.php');
    $c=new controller();
    $ps=$_GET['iddevis'];
    $c-> confirme_prix($ps);