<?php

require_once __DIR__.'/includes/config.php';

	

	return \es\ucm\fdi\aw\mensajes\Mensaje::getChat($_POST['incoming_id'],$_POST['subasta_id']) ;
    ?>