<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'CrearSubasta';
$contenidoPrincipal=<<<EOS
  <h1>Página principal</h1>
  <p> Aquí está el contenido público, visible para todos los usuarios. </p>
EOS;
?>
<?php
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaCrearSubasta.php', $params);
?>