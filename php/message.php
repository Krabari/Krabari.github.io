<?php

include "Message.class.php";
include "Utilities.class.php";

$page = new Message(
					"../css/style.css", 
					"../css/normalize.css", 
					"", 
					"../js/main.js", 
					"", 
					"", 
					"../phtml/message.phtml"	
);
$page->main();

$fct = new Utilities();

include "../master.phtml";