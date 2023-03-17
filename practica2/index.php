<?php

require_once __DIR__.'/includes/config.php';



$tituloPagina = 'Portada';
$contenidoPrincipal=<<<EOS
<div id="carrusel">
</div>

EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaInicio.php', $params);