<?php

// Classe permettant d'afficher des notifications (ou des messages d'erreurs)
// Elle sera utilisée pour la messagerie. 

class FlashBag2 extends FlashBag{

    public function __construct($session){
        parent::__construct($session);
    }

}

