<?php

include "Init.class.php";

// Classe permettant de supprimer ou non une réponse:

class Remove_answer extends Init{

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

        // Avec l'url ou le bouton de suppression, on ne peut supprimer que ses propres réponses 
        if(array_key_exists("id_msg", $_GET)){
            $query = $this->pdo->prepare(
                'SELECT ? IN (SELECT id FROM message) as existe'
            );

            $query->execute(array($_GET["id_msg"]));
            $message = $query->fetch(PDO::FETCH_ASSOC);

            // on verifie si l'id du message existe:
            if(!intval($message['existe'])){
                header('Location: http://localhost/3wa/Portfolio/index.php');
            }

            else if (array_key_exists("id", $_GET) && array_key_exists("id_user", $_GET) && $this->userSession->getId() == $_GET["id_user"]){
                $query = $this->pdo->prepare(
                    'DELETE FROM reponse WHERE id = ?'
                );

                $query->execute(array($_GET["id"]));

                // On ajoute en mémoire un message de notification qui s'affichera sur la page d'accueil.
                $this->flashBag = new FlashBag("flash-bag");
                $this->flashBag->ajouter("Une réponse a été supprimé.");  

                header('Location: http://localhost/3wa/Portfolio/php/message.php?id=' . $_GET['id_msg']);
            }

            else{
                header('Location: http://localhost/3wa/Portfolio/php/message.php?id=' . $_GET['id_msg']);
            }
        }

        // Sinon on est redirigé vers le site d'accueil
        else{
            header('Location: http://localhost/3wa/Portfolio/index.php');
        }

    }
    
}