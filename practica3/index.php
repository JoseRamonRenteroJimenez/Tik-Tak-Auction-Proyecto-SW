<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Portada';
$contenidoPrincipal=<<<EOS
<<<<<<< HEAD
<<<<<<< HEAD
  <h1>Página principal</h1>
  <p> Aquí está el contenido público, visible para todos los usuarios. </p>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);
=======
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
<div id="carrusel">

<p>Guia para probar la aplicacion: </p>

<p>Usuario:particular Contraseña:userpass</p>
<p>El boton de buscar de arriba a la derecha una vez logueado muestra todas las subastas y un boton para pujar que lleva a la pagina de esa subasta y permite pujar</p>
<p>Una vez logueado con un usuario cliclando en mi perfil (Arriba a la derecha) te muestra subastas y opciones para modificarlas, eliminarlas o crear nuevas (de momento no hace
filtrado para que muestre las de su usuario solo)</p>
</div>

EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
<<<<<<< HEAD
$app->generaVista('/plantillas/plantillaInicio.php', $params);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
$app->generaVista('/plantillas/plantillaInicio.php', $params);
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
