<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/subastas/listadoSubastas.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal='';

if ($app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::USER_ROLE)||$app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::BUSSINES_ROLE)) {
    
    $addsubastaUrl = $app->resuelve('/addSubasta.php');
<<<<<<< HEAD
    $listsubastaUrl = $app->resuelve('/verSubastas.php');

  $contenidoPrincipal=<<<EOS
    <h1>Vista general de subastas en Mi tiktak </h1>
    <div>
    <a href="url">Actividad</a>
    <a href="url">Mensajes</a>
    <a href="url">Noticias</a>
   
    </div>
    <a href="{$addsubastaUrl}">subir subasta</a>
    <a href="{$listsubastaUrl}">ver subastas</a>
=======
    $mensajes = $app->resuelve('/chat.php');
    $actividad = $app->resuelve('/actividadPerfil.php');
    $notificaciones = $app->resuelve('/listaNotificaciones.php');
    $listarsubastas = new \es\ucm\fdi\aw\subastas\listadoSubastas();
    $listarsubastas = $listarsubastas->gestiona();   

  $contenidoPrincipal=<<<EOS

                            <div>
                          
                            <a href="{$addsubastaUrl}">subir subasta</a>
                            $listarsubastas
                            </div>

    
>>>>>>> origin/alberto-branch
  EOS;
  $contenidoPrincipal .= \es\ucm\fdi\aw\subastas\listasubastas();
 
} else {
  $contenidoPrincipal=<<<EOS
    <h1>Usuario no registrado!</h1>
    <p>Debes iniciar sesión para ver el contenido.</p>
    
  EOS;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaPerfil.php', $params);