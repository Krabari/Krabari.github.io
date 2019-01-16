<?php

// Classe répresentant la session de connexion d'utilisateur avec toutes ses propriétés:

class UserSession{

	public function __construct(){
		// démarrage de session PHP
        if(session_status() === PHP_SESSION_NONE){            
            session_start();
        }
	}
	
	public function creerSession($id, $nom, $prenom, $mail, $pseudo){
		$_SESSION['user']['id'] = $id;
		$_SESSION['user']['nom'] = $nom;
		$_SESSION['user']['prenom'] = $prenom;
		$_SESSION['user']['mail'] = $mail;
		$_SESSION['user']['pseudo'] = $pseudo;		
	}
	
	public function estConnecte(){
		return (array_key_exists('user', $_SESSION) && !empty($_SESSION['user']));
	}

	public function getId(){
		if($this->estConnecte()){
			return $_SESSION['user']['id'];
		}
		else{
			return null;
		}		
	}

	public function getNom(){
		if($this->estConnecte()){
			return $_SESSION['user']['nom'];
		}
		else{
			return null;
		}		
	}

	public function getPrenom(){
		if($this->estConnecte()){
			return $_SESSION['user']['prenom'];
		}
		else {
			return null;
		}
	}	

	public function getMail(){
		if($this->estConnecte()){
			return $_SESSION['user']['mail'];
		}
		else{
			return null;
		}		
	}

	public function getPseudo(){
		if($this->estConnecte()){
			return $_SESSION['user']['pseudo'];
		}
		else{
			return null;
		}		
	}

	public function destroy(){
		$_SESSION = array();			
		session_destroy();
	}
	
}