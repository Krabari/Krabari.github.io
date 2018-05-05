<?php

include "Init.class.php";

// Classe permettant d'empêcher d'accèder au formulaire de connexion lorsqu'on est connecté:

class Login extends Init{
    
    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        parent::__construct($path1, $path2, $path3, $path4, $path5, $path6, $path7);
    }

    public function main(){
        if ($this->userSession->estConnecte()){
            header('Location: http://localhost/3wa/Portfolio/index.php');
        }        
    }

}
