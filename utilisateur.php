<?php
class utilisateur{
	private $nom;
	private $prenom;
    private $dateNaissance; 
    private $sexe; 
    private $adresse; 
	private $pseudo;
	private $motDePasse;
	private $adresseMail;
	private $bool;

	
	
	function __construct($surname,$name, $date, $sexe,$adresse,$username,$passe,$email,$bool){
		$this->nom=$surname;
		$this->prenom=$name;
		$this->dateNaissance=$date;
		$this->sexe=$sexe;
		$this->adresse=$adresse;
		$this->pseudo=$username;
		$this->motDePasse=sha1($passe);
		$this->adresseMail=$email;
		$this->bool=$bool;
		
	}
	
	function getNom(){
		return $this->nom;
	}
	
	function getPrenom(){
		return $this->prenom;
	}
    function getDateNaissance(){
		return $this->dateNaissance;
	}
    function getSexe(){
		return $this->sexe;
	}
    function getAdresse(){
		return $this->adresse;
	}
    
	function getPseudo(){
		return $this->pseudo;
	}
	function getPasse(){
		return $this->motDePasse;
	}	
	function getEmail(){
		return $this->adresseMail;
	}
	function getBool(){
		return $this->bool;
	}
   
}