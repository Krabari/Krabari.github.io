<?php

include "Init.class.php";

// Classe permettant la déconnexion d'un utilisateur:

class Logout extends Init{
    
    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

		if($this->userSession->estConnecte()){
			$this->userSession->destroy();

			// On ajoute en mémoire un message de notification qui s'affichera sur la page d'accueil.
			$this->flashBag = new flashBag("flash-bag");
			$this->flashBag->ajouter("Déconnexion établie avec succès.");
		}

		// Dans le cas ou on est déconnecté et que l'on tente de taper le chemin vers le fichier "logout.php" dans l'url, on est redirigé vers le site d'accueil.
		header('Location: http://localhost/3wa/Portfolio/index.php');

    }

}