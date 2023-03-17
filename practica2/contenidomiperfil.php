<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/subastas/listadoSubastas.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal='';
$contenido='ventas';
if ($app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::USER_ROLE)||$app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::BUSSINES_ROLE)) {
    
    $addsubastaUrl = $app->resuelve('/addSubasta.php');
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> origin/Sergio-Branch
    
  $contenidoPrincipal=<<<EOS

                            <div>
                          
                            <a href="{$addsubastaUrl}">subir subasta</a>
                            
                            </div>

    
  EOS;
  $contenido=$_GET["ventas"];

$contenidoPrincipal .= \es\ucm\fdi\aw\subastas\listasubastas($contenido);
 
<<<<<<< HEAD
=======
    $listarsubastaUrl = $app->resuelve('/verSubastas.php');
    $borrarsubastaUrl = $app->resuelve('/vistaBorrarSubastas.php');
       

  $contenidoPrincipal=<<<EOS
    <h1>Vista general de subastas en Mi tiktak </h1>
    <div>
    <a href="url">Actividad</a>
    <a href="url">Mensajes</a>
    <a href="url">Noticias</a>
   
    </div>
    <a href="{$addsubastaUrl}">subir subasta</a>
    <a href="{$listarsubastaUrl}">ver subastas</a>
    <a href="{$borrarsubastaUrl}">eliminar subastas</a>
  EOS;
>>>>>>> origin/Sergio-Branch
=======
>>>>>>> origin/Sergio-Branch
} else {
  $contenidoPrincipal=<<<EOS
    <h1>Usuario no registrado!</h1>
    <p>Debes iniciar sesión para ver el contenido.</p>
    
  EOS;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaPerfil.php', $params);