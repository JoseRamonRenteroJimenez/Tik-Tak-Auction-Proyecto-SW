<?php

require_once __DIR__.'/includes/config.php';

$borrarSubastas = new \es\ucm\fdi\aw\subastas\borrarSubastas();
$borrarSubastas = $borrarSubastas->gestiona();

 
$tituloPagina = 'Borrar';
$contenidoPrincipal=<<<EOF
  	<h1>Listado de subasta</h1>
      $borrarSubastas
    
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaPerfil.php', $params);
