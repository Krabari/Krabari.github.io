<?php

include "Init.class.php";

// Classe permettant d'ajouter une nouvelle réponse à un message:

class Add_answer extends Init{

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

        // cas ou on envoie les données pour une réponse:
        if ($this->userSession->estConnecte() && !empty($_POST)){
            $query = $this->pdo->prepare(
                'INSERT INTO reponse (id_user, id_message, contenu, date)
                VALUES
                (?, ?, ?, CURRENT_TIMESTAMP)'
            );

            $contenu_msg = $_POST['ecrire_msg'];

            // Dans le cas ou le contenu est vide ou qu'il ne contient que des espaces: 
            if ($_POST['ecrire_msg'] == "" || ctype_space($contenu_msg)){
                $contenu_msg = "(pas de contenu)";
            }

            $query->execute(array($this->userSession->getId(), $_POST['id_msg'], $contenu_msg));

            // On ajoute en mémoire un message de notification qui s'affichera sur la page d'accueil.
            $this->flashBag = new FlashBag("flash-bag");
            $this->flashBag->ajouter("Une nouvelle réponse a été ajouté.");

            header('Location: http://localhost/3wa/Portfolio/php/message.php?id=' . $_POST['id_msg']);
        }

        // Dans le cas ou on tente de taper le chemin vers le fichier "add_answer.php" dans l'url,
        // on est redirigé vers le site d'accueil pour ne pas envoyer de messages vides.
        else{
            header('Location: http://localhost/3wa/Portfolio/index.php');
        }

    }
    
}