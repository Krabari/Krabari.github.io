<?php

include "Init.class.php";
include "Utilities.class.php";

// Classe représentant la connexion d'un utilisateur:

class Open_session extends Init{

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

        $fct = new Utilities();

        // Cas ou la connexion d'un utilisateur peut se faire:
        if (!empty($_POST)){

            $sql = 'SELECT id, nom, prenom, mail, pseudo, motdepasse FROM user WHERE pseudo = ?';

            $query = $this->getPdo()->prepare($sql);
            $query->execute([$_POST['pseudo']]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // Messages erreur...
            if(empty($user) || !$fct->verifierMotDePasse($_POST['motdepasse'], $user['motdepasse'])){
                $_SESSION['POST'] = $_POST;

                $this->flashBag = new FlashBag("flash-bag");

                // si l'utilisateur n'existe pas 
                if(empty($user)){
                    $this->flashBag->ajouter("Pseudo incorrect: cet utilisateur n'existe pas.");
                }
                // si le c'est le mauvais mot de passe d'un utilisateur existant 
                else if(!$fct->verifierMotDePasse($_POST['motdepasse'], $user['motdepasse'])){
                    $this->flashBag->ajouter("Mot de passe incorrect !");   
                }

                header('Location: http://localhost/3wa/Portfolio/php/login.php'); 
            }

            else{
                $this->userSession->creerSession($user['id'], $user['nom'], $user['prenom'], $user['mail'], $user['pseudo']);
                        
               // On ajoute en mémoire un message de notification qui s'affichera sur la page d'accueil.
                $this->flashBag->ajouter("Connexion établie avec succès.");

                header('Location: http://localhost/3wa/Portfolio/index.php');
            }
        }

        // Dans d'autres cas, comme quand on tente d'acceder à cette page (open_session.php) avec l'url en étant connecté, on est redirigé vers le site d'accueil
        else{
            header('Location: http://localhost/3wa/Portfolio/index.php');
        }  

    }
    
}