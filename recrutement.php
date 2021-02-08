<?php 
include_once('vue.php');
//include_once('./PHPMailer-master/src/PHPMailer.php');
//$mail = new PHPMailer();
$c=new accueil();
$c->recrutement();



	
	
	/*
	$mail->CharSet = 'UTF-8';
	// Indique le nom de l'expéditeur (le site du client)
	$mail->FromName="METTRE ICI LE NOM DE L'EXPEDITEUR";
	//Recuperation adresse mail expediteur
	$mail->SetFrom="merry.nonim@gmail.com";
	//Indique à qui sera envoye l'email (le client qui détient le site internet)
	$mail->AddAddress('gm_yousfi@esi.dz');
	// Indique le Blind Carbon Copy
	$mail->AddBCC("gm_yousfi@esi.dz");
	//Indique l'objet du mail
	$mail->Subject = 'METTRE ICI LE MESSAGE DU SITE INTERNET';
	//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
	$mail->Body = (
	"Prénom, NOM :" .htmlspecialchars("mimi", ENT_QUOTES,'UTF-8').$saut.
	"Numéro de téléphone :" .htmlspecialchars("0551824148", ENT_QUOTES,'UTF-8').$saut.
	"Adresse E-mail :" .htmlspecialchars("gm_yousfi@esi.dz", ENT_QUOTES,'UTF-8').$saut.
    "Message :" .htmlspecialchars("hiho", ENT_QUOTES,'UTF-8'));
    $mail->Send();
*/