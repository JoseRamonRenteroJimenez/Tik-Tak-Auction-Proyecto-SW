<?php

require_once __DIR__.'/includes/config.php';

$formRegistroObjeto = new \es\ucm\fdi\aw\subastas\FormularioObjeto();
$formRegistroObjeto = $formRegistroObjeto->gestiona();
$formUpload = new \es\ucm\fdi\aw\subastas\FormularioUpload();
$htmlFormUpload = $formUpload->gestiona();

$tituloPagina = 'Registro';
$contenidoPrincipal=<<<EOF
  	<h1>Registro de subasta</h1>
    $formRegistroObjeto
    $htmlFormUpload 
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);