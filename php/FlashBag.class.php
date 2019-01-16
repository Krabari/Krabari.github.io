<?php

// Classe permettant d'afficher des notifications (ou des messages d'erreurs)

class FlashBag{

    protected $session;

    public function __construct($session){
        $this->session = $session;

        // démarrage de session PHP
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

        if(array_key_exists($this->session, $_SESSION) == false)
        {
            $_SESSION[$this->session] = array();
        }
    }

    // fonction qui empile dans le tableau "$_SESSION['flash-bag']" un message 
    public function ajouter($message){
        array_push($_SESSION[$this->session], $message);
    }

    // fonction qui vérifie si le tableau "$_SESSION['flash-bag']" contient des messages 
    public function contientMessages(){
        return empty($_SESSION[$this->session]) == false;
    }

    // fonction qui renvoie tous les messages du tableau avant de le vider 
    public function Messages(){
        $messages = $_SESSION[$this->session];
        $_SESSION[$this->session] = array();
        
        return $messages;
    }

}