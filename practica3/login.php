<?php

require_once __DIR__.'/includes/config.php';

$formLogin = new \es\ucm\fdi\aw\usuarios\FormularioLogin();
$formLogin = $formLogin->gestiona();


$tituloPagina = 'Login';
$contenidoPrincipal=<<<EOF
<<<<<<< HEAD
  	<h1>Acceso al sistema</h1>
    $formLogin
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
<<<<<<< HEAD
$app->generaVista('/plantillas/plantilla.php', $params);
=======
$app->generaVista('/plantillas/plantillaLoginRegistro.php', $params);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
$formLogin
EOF;


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaLoginRegistro.php', $params);
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
