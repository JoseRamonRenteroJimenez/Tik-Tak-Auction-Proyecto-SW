<?php

require_once __DIR__.'/includes/config.php';

$ActualizarSubastas = new \es\ucm\fdi\aw\subastas\actualizarSubastas();
$ActualizarSubastas = $ActualizarSubastas->gestiona();

 
$tituloPagina = 'Borrar';
$contenidoPrincipal=<<<EOF
  	<h1>Listado de subasta</h1>
      $ActualizarSubastas
    
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaPerfil.php', $params);
