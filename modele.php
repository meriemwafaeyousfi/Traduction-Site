<?php

require_once('vue.php');
Class modele{

 private  $servername = "localhost";
 private $username = "root";
 private $password = "";
 private $dbnam="projet";

/**********connexion*************************************/
 public function connexion($servername,$username,$password,$dbnam){
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbnam", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
      echo "not Connected ";
    }
   return $conn;  
 }
/******deconnexion*****************************************/
 public function deconnexion(&$c)
 {
    $conn = null;
 }
}







    ////important 
    /*
    
    $nom = $_POST['nom'];
    $psw = $_POST['psw'];

   */

   
    
  
?>