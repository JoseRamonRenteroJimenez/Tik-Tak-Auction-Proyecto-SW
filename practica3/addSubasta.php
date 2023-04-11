<?php

require_once __DIR__.'/includes/config.php';

$formRegistroObjeto = new \es\ucm\fdi\aw\subastas\FormularioObjeto();
$formRegistroObjeto = $formRegistroObjeto->gestiona();

<<<<<<< HEAD

=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
$tituloPagina = 'Registro';
$contenidoPrincipal=<<<EOF
  	<h1>Registro de subasta</h1>
    $formRegistroObjeto
<<<<<<< HEAD
=======
   
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);