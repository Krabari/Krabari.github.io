<?php

// Classe permettant définir des fonctions qui seront réutilisés dans tous les autres fichiers .

class Utilities{

    public function __construct(){
        
    }

    // fonction qui renvoie les 200 premiers caracteres d'une chaine
    public function les_200_premiers($chaine){
        return substr($chaine, 0, 200);
    }

    // fonction qui formate une date de type DATETIME en date française
    public function formatDateFrance($sql_date){
        $date = new DateTime($sql_date);
        return $date->format('d/m/Y \à H\hi');
    }

    // fonction qui met un mot au pluriel si $nombre > 2 
    public function pluriel_ou_pas($nombre, $chaine){
        if($nombre > 1){
            $chaine .= 's';
        }
        return $nombre . ' ' . $chaine;
    }

    // fonction qui transforme un mot de passe en version cryptée 
    public function motDePasseCryptee($motdepasse){
        $crypte = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);            
        return crypt($motdepasse, $crypte);
    }

    // Si le "vrai" mot de passe est le même que la version cryptée alors renvoie vrai 
    public function verifierMotDePasse($motdepasse, $motdepassecryptee){
        if(crypt($motdepasse, $motdepassecryptee) == $motdepassecryptee){
            return true;
        }
        else{
            return false;
        }
    } 
 
    // fonction qui permet d'afficher des messages d'erreurs ou des notifications success
    public function notification($tableau){
        if($tableau->getFlashBag()->contientMessages()){ 
            foreach($tableau->getFlashBag()->Messages() as $msg){
                echo $msg;
            }
        }
    }

    // fonction qui permet d'afficher des messages d'erreurs ou des notifications success
    public function notification2($tableau){
        if($tableau->getFlashBag2()->contientMessages()){ 
            foreach($tableau->getFlashBag2()->Messages() as $msg){
                echo $msg;
            }
        }
    }
              
}