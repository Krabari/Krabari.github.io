<?php

include "Init.class.php";

// Classe permettant de supprimer ou non un message dans la messagerie:

class Remove_message extends Init{

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

        // On ne peut supprimer que ses propres messages 
        if($this->userSession->estConnecte() && array_key_exists("idmsg", $_GET)){
            $query1 = $this->pdo->prepare(
                'SELECT ? IN (SELECT id FROM message) as existe'
            );

            $query2 = $this->pdo->prepare(
                'SELECT id_user as x FROM message WHERE id = ?'
            );

            // premiere verification: est-ce que l'id du message que l'on veut supprimer existe ?
            $query1->execute(array($_GET["idmsg"]));
            $message = $query1->fetch(PDO::FETCH_ASSOC);

            // deuxième verification: est-ce que l'auteur du message que l'on veut supprimer 
            // est le même que celui qui est connecté en ce moment ?
            $query2->execute(array($_GET["idmsg"]));
            $tab = $query2->fetch(PDO::FETCH_ASSOC);
            $idusermsg = intval($tab['x']);

            // vérifications:
            if(!intval($message['existe']) || $idusermsg != $this->userSession->getId()){
                header('Location: http://localhost/3wa/Portfolio/index.php#mess');
            }

            else{
                // Lors de la suppression d'un message publié, 
                // on supprime d'abord toutes ses réponses (si il y'en a). 
                // Une fois que ses réponses sont toutes supprimées, on peut supprimer le message de la liste. 
                $query3 = $this->pdo->prepare(
                    'DELETE FROM reponse WHERE id_message = ?'
                );

                $query4 = $this->pdo->prepare(
                    'DELETE FROM message WHERE id = ?'
                );

                $query3->execute(array($_GET["idmsg"]));

                $query4->execute(array($_GET["idmsg"]));

                // On ajoute en mémoire un message de notification qui s'affichera sur la page d'accueil.
                $this->flashBag2 = new FlashBag2("flash-bag2");
                $this->flashBag2->ajouter("Un message a été supprimé.");

                header('Location: http://localhost/3wa/Portfolio/index.php#mess');
            }
        }

        // On est redirigé vers la messagerie
        header('Location: http://localhost/3wa/Portfolio/index.php#mess');

    }
    
}