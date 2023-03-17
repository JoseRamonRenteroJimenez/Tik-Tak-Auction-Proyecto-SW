<?php

require_once __DIR__.'/includes/config.php';

$borrarSubastas = new \es\ucm\fdi\aw\subastas\borrarSubastas();
$borrarSubastas = $borrarSubastas->gestiona();

 
<<<<<<< HEAD
$tituloPagina = 'Registro';
=======
$tituloPagina = 'Borrar';
>>>>>>> origin/alberto-branch
$contenidoPrincipal=<<<EOF
  	<h1>Listado de subasta</h1>
      $borrarSubastas
    
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
<<<<<<< HEAD
$app->generaVista('/plantillas/plantillaBorrado.php', $params);
=======
$app->generaVista('/plantillas/plantillaPerfil.php', $params);
>>>>>>> origin/alberto-branch
