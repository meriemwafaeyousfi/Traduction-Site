<?php
class dmddevis{
	private $nom;
	private $prenom;
    private $mail; 
    private $tel; 
    private $typetraduction;
    private $source; 
	private $langue;
	private $message;
	

	
	
	function __construct($surname,$name, $mail, $tel,$type,$src,$lang,$msg){
		$this->nom=$surname;
		$this->prenom=$name;
        $this->mail=$mail;
        $this->tel=$tel;
		$this->typetraduction=$type;
		$this->source=$src;
		$this->langue=$lang;
		$this->message=$msg;
		
		
	}
	
	function getNom(){
		return $this->nom;
	}
	
	function getPrenom(){
		return $this->prenom;
	}
    function getMail(){
		return $this->mail;
	}
    function getTel(){
		return $this->tel;
	}
    function getType(){
		return $this->typetraduction;
	}
    
	function getSource(){
		return $this->source;
	}
	function getLangue(){
		return $this->langue;
	}	
	function getMsg(){
		return $this->message;
	}
   
}