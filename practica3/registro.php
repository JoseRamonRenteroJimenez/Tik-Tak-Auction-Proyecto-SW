<?php

require_once __DIR__.'/includes/config.php';

$formRegistro = new \es\ucm\fdi\aw\usuarios\FormularioRegistro();
$formRegistro = $formRegistro->gestiona();


$tituloPagina = 'Registro';
$contenidoPrincipal=<<<EOF
  	<h1>Registro de usuario</h1>
    $formRegistro
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
<<<<<<< HEAD
$app->generaVista('/plantillas/plantilla.php', $params);
=======
$app->generaVista('/plantillas/plantillaLoginRegistro.php', $params);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
