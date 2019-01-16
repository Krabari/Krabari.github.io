<?php

include "Login.class.php";
include "Utilities.class.php";

$page = new Login(
			"../css/style.css", 
			"../css/normalize.css", 
			"", 
			"../js/main.js", 
			"", 
			"", 
			"../phtml/login.phtml"
);
$page->main();

$fct = new Utilities();

include "../master.phtml";

unset($_SESSION['POST']);