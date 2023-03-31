<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/subastas/listadoSubastas.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal='';
$contenido='ventas';

$idpuja=$_POST["idsubasta"];

$hacerpuja= new \es\ucm\fdi\aw\subastas\hacerPuja();
$hacerpuja = $hacerpuja->gestiona();

 
$tituloPagina = 'Borrar';
$contenidoPrincipal=<<<EOF
  	<h1>subsata a pujar</h1>
      $hacerpuja
    
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaInicio.php', $params);


