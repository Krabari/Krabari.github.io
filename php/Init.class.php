<?php

include "UserSession.class.php";
include "FlashBag.class.php";
include "FlashBag2.class.php";

// Classe permettant définir des variables qui seront réutilisés dans tous les autres fichiers.

class Init{

    protected $userSession;
    protected $flashBag;
    protected $flashBag2;    
    protected $pdo;

    // Chacune des variables ci-dessous réprésentera du code phtml (header, footer...) que l'on incluera dans master.phtml. 
    // Ces variables seront redéfinies ou modifiées dans d'autres fichiers selon des besoins d'affichage: 
    protected $style_css;
    protected $normalize_css;
    protected $head;
    protected $scripts;
    protected $footer;
    protected $navigation;
    protected $template_name;

    public function __construct($path1, $path2, $path3, $path4, $path5, $path6, $path7){
        $this->userSession = new UserSession();
        $this->flashBag = new FlashBag("flash-bag");
        $this->flashBag2 = new FlashBag2("flash-bag2");

        $this->pdo = new PDO('mysql:host=localhost;dbname=portfolio', 'root', 'kenrab');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec('SET NAMES UTF8');

        $this->style_css = $path1;
        $this->normalize_css = $path2;
        $this->head = $path3;
        $this->scripts = $path4;
        $this->footer = $path5;
        $this->navigation = $path6;
        $this->template_name = $path7;          
    }

    public function getUserSession(){
        return $this->userSession;
    }

    public function getFlashBag(){
        return $this->flashBag;
    }

    public function getFlashBag2(){
        return $this->flashBag2;
    }

    public function getPdo(){
        return $this->pdo;
    }

    ///////////////////////////////////////////////////////////////////////////

    public function getStyle_css(){
        return $this->style_css;
    }

    public function getNormalize_css(){
        return $this->normalize_css;
    }

    public function getHead(){
        return $this->head;
    }

    public function getScripts(){
        return $this->scripts;
    }

    public function getFooter(){
        return $this->footer;
    }

    public function getNavigation(){
        return $this->navigation;
    }

    public function getTemplate_name(){
        return $this->template_name;
    }    
        
}
