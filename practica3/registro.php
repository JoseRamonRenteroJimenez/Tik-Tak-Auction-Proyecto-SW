<?php

require_once __DIR__.'/includes/config.php';

$formRegistro = new \es\ucm\fdi\aw\usuarios\FormularioRegistro();
$formRegistro = $formRegistro->gestiona();


$tituloPagina = 'Registro';
$contenidoPrincipal=<<<EOF
<<<<<<< HEAD
  	<h1>Registro de usuario</h1>
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
    $formRegistro
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
<<<<<<< HEAD
<<<<<<< HEAD
$app->generaVista('/plantillas/plantilla.php', $params);
=======
$app->generaVista('/plantillas/plantillaLoginRegistro.php', $params);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
$app->generaVista('/plantillas/plantillaLoginRegistro.php', $params);
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
