<?php

include "Init.class.php";
include "Utilities.class.php";

// Classe permettant de créer un nouvel utilisateur:

class Add_user extends Init{

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){

        $fct = new Utilities();
        
        // Cas ou on envoie les données d'un nouvel utilisateur lors d'une nouvelle inscription:
        if(!empty($_POST)){

            // Messages d'erreur...
            if($_POST['motdepasse'] != $_POST['motdepasse2'] || strlen($_POST['motdepasse']) < 8){
                $_SESSION['POST'] = $_POST;

                $this->flashBag = new FlashBag("flash-bag");

                // si les deux mots de passe crées sont différents
                if($_POST['motdepasse'] != $_POST['motdepasse2']){
                    $this->flashBag->ajouter("Echec de la création du mot de passe: veuillez recommencer");
                }
                // si le mot de passe crée fait moins de 8 caractères  
                else if(strlen($_POST['motdepasse']) < 8){
                    $this->flashBag->ajouter("Votre mot de passe doit contenir au moins 8 caractères !");
                }
                header('Location: http://localhost/3wa/Portfolio/php/inscription.php');
            }

            else{
                $query = $this->pdo->prepare(
                    'INSERT INTO user (nom, prenom, mail, pseudo, motdepasse)
                    VALUES
                    (?, ?, ?, ?, ?)'
                );

                $query->execute(array(trim($_POST['nom']), trim($_POST['prenom']), trim($_POST['email']), trim($_POST['pseudo']), trim($fct->motDePasseCryptee($_POST['motdepasse']))));

                // On ajoute en mémoire un message de notification qui s'affichera sur la page d'accueil.
                $this->flashBag = new FlashBag("flash-bag");
                $this->flashBag->ajouter("Inscription établie avec succès.");

                header('Location: http://localhost/3wa/Portfolio');
            }

        }

        // Dans le cas ou on tente de taper le chemin vers le fichier "add_user.php" dans l'url,
        // on est redirigé vers le site d'accueil pour éviter des nouvelles données vides.
        else{
            header('Location: http://localhost/3wa/Portfolio');
        }

    }
    
}