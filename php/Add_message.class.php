<?php

include "Init.class.php";

// Classe permettant d'ajouter un nouveau message dans la messagerie:

class Add_message extends Init{
    
    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

		// cas ou on envoie les données pour publier un message dans la messagerie:
		if($this->userSession->estConnecte() && !empty($_POST)){
			$query = $this->pdo->prepare(
				'INSERT INTO message (titre, date, id_user, contenu)
				VALUES
				(?, CURRENT_TIMESTAMP, ?, ?)'
			);

			$objet_msg = $_POST['object'];
			$contenu_msg = $_POST['ecrire'];

			// Cas ou l'objet du message est vide ou qu'il ne contient que des espaces: 
			if($_POST['object'] == "" || ctype_space($objet_msg)){
				$objet_msg = "(pas d'objet)";
			}

			// Cas ou le contenu du message est vide ou qu'il ne contient que des espaces: 
			if($_POST['ecrire'] == "" || ctype_space($contenu_msg)){
				$contenu_msg = "(pas de contenu)";
			}

			$query->execute(array($objet_msg, $this->userSession->getId(), $contenu_msg));

			// On ajoute en mémoire un message de notification qui s'affichera sur la page d'accueil.
			//$flashBag2 = new FlashBag2("flash-bag2");
			$this->flashBag2->ajouter("Un nouveau message a été ajouté.");
		}

		// Dans tous les cas (taper le chemin du fichier dans l'url ou envoi des données), 
		// on est redirigé vers la messagerie
		header('Location: http://localhost/3wa/Portfolio/index.php#mess');

    }

}