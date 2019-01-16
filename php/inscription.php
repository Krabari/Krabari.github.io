<?php

include "Inscription.class.php";
include "Utilities.class.php";

$page = new Inscription(				
				"../css/style.css", 
				"../css/normalize.css", 
				"", 
				"../js/main.js", 
				"", 
				"", 
				"../phtml/inscription.phtml"
);
$page->main();

$fct = new Utilities();

include "../master.phtml";

unset($_SESSION['POST']);


