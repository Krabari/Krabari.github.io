<?php

include "Index.class.php";
include "php/Utilities.class.php";

$page = new Index(
				"css/style.css", 
				"css/normalize.css", 
				"phtml/head.phtml", 
				"js/main.js", 
				"phtml/footer.phtml", 
				"phtml/navigation.phtml", 
				"phtml/index.phtml"
);
$page->main();

$fct = new Utilities();

//include "master.phtml";
include "index.html";


