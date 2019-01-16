<?php

include "php/Init.class.php"; 

// Classe réprésentant la page d'accueil du site:

class Index extends Init{

    protected $messages;

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){
        $query = $this->pdo->prepare(
            'SELECT message.id, message.titre, message.contenu, message.date, message.id_user, user.prenom, user.nom, count( reponse.id ) AS nbc
            FROM message
            INNER JOIN user ON message.id_user = user.id
            LEFT JOIN reponse ON reponse.id_message = message.id 
            GROUP BY message.id'
        );

        $query->execute();
        $this->setMessages($query->fetchAll(PDO::FETCH_ASSOC));   
    }

    public function getMessages(){
        return $this->messages;
    }

    public function setMessages($msg){
        $this->messages = $msg;
    }

    // On veut écrire les 20 premiers caractères d'un message de la messagerie
    public function debutparagraphe($tableau, $fct){
        $chaine = $tableau['contenu'];
        $chaine2 = $fct->les_200_premiers($chaine);
        echo $chaine2;

        if(strlen($chaine) > 200){
            echo '... <a href="php/message.php?id=' . $tableau['id'] . '" title="voir le message en détail"><small class="souligne">Lire la suite</small></a>';
        }
    }                  
    
}


