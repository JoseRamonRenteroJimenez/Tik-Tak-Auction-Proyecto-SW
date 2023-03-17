<?php

require_once __DIR__.'/includes/config.php';



$tituloPagina = 'Portada';
$contenidoPrincipal=<<<EOS
<div id="carrusel">
</div>

EOS;
?>
<?php
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaIndex.php', $params);
?>

