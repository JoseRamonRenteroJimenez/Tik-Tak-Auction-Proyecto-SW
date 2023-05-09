<?php 
       require_once __DIR__.'/includes/config.php';
       require_once __DIR__.'/includes/src/usuarios/Usuario.php';
       
           
       
           return \es\ucm\fdi\aw\mensajes\Mensaje::InsertChat($_POST['subasta_id'],$_POST['message'],$_POST['incoming_id']) ;
        
       
?>