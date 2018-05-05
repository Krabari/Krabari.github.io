<?php

include "Init.class.php";

// Classe réprésentant un message avec ses réponses:

class Message extends Init{

    protected $unMessage; // tableau qui contiendra toutes les propriétés du message (auteur, contenu...)
    protected $nbrep;     // entier qui représentera le nombre de réponses du message
    protected $reponses;  // tableau qui contiendra toutes les réponses du message

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

        // La page d'un message n'existe que si l'url est de la forme "message.php?id=..."
        if (array_key_exists("id", $_GET)){

            $query0 = $this->pdo->prepare(
                'SELECT ? IN (SELECT id FROM message) as existe'
            );

            $query0->execute(array($_GET["id"]));
            $message = $query0->fetch(PDO::FETCH_ASSOC);;

            // Si, dans l'url, l'id d'un message n'existe pas, alors:
            if(!intval($message['existe'])){
                header('Location: http://localhost/3wa/Portfolio/index.php#mess');
            }           

            else{
                $query1 = $this->pdo->prepare(
                    'SELECT message.id, message.titre, message.date, message.id_user, message.contenu, user.nom, user.prenom, user.mail
                    FROM message
                    INNER JOIN user ON message.id_user = user.id
                    WHERE message.id = ?'
                );  

                $query2 = $this->pdo->prepare(
                    'SELECT reponse.id, reponse.id_user, user.pseudo, reponse.date, reponse.contenu
                    FROM reponse
                    INNER JOIN user ON reponse.id_user = user.id
                    WHERE reponse.id_message = ?
                    ORDER BY reponse.id'
                );  

                $query1->execute(array($_GET['id']));
                $this->setUnMessage($query1->fetch(PDO::FETCH_ASSOC));

                $query2->execute(array($_GET['id']));
                $this->setReponses($query2->fetchAll(PDO::FETCH_ASSOC));

                $this->setNbRep(count($this->reponses));
            }
        }

        // Dans d'autres cas, on est redirigé vers le site d'accueil."
        else{
            header('Location: http://localhost/3wa/Portfolio');
        }

    }

    public function getUnMessage(){ 
        return $this->unMessage;
    }

    public function setUnMessage($msg){ 
        $this->unMessage = $msg;
    }    
    
    public function getNbRep(){ 
        return $this->nbrep;
    }

    public function setNbRep($x){ 
        $this->nbrep = $x;
    }

    public function getReponses(){ 
        return $this->reponses;
    }

    public function setReponses($rep){ 
        $this->reponses = $rep;
    }      
}