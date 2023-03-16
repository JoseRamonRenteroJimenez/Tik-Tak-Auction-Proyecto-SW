<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/subastas/listadoSubastas.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal='';
$contenido='ventas';
if ($app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::USER_ROLE)||$app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::BUSSINES_ROLE)) {
    
    $addsubastaUrl = $app->resuelve('/addSubasta.php');
    $mensajes = $app->resuelve('/chat.php');
    $actividad = $app->resuelve('/actividadPerfil.php');
    $notificaciones = $app->resuelve('/listaNotificaciones.php');
  $contenidoPrincipal=<<<EOS

                            <div>
                          
                            <a href="{$addsubastaUrl}">subir subasta</a>
                            
                            </div>

    
  EOS;


$contenidoPrincipal .= \es\ucm\fdi\aw\subastas\listasubastas($_GET["ventas"]);
 
} else {
  $contenidoPrincipal=<<<EOS
    <h1>Usuario no registrado!</h1>
    <p>Debes iniciar sesión para ver el contenido.</p>
    
  EOS;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaPerfil.php', $params);