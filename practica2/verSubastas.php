<?php

require_once __DIR__.'/includes/config.php';

$ListadoSubastas = new \es\ucm\fdi\aw\subastas\ListadoSubastas();
$ListadoSubastas = $ListadoSubastas->gestiona();

 
$tituloPagina = 'Registro';
$contenidoPrincipal=<<<EOF
  	<h1>Listado de subasta</h1>
      $ListadoSubastas
    
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);