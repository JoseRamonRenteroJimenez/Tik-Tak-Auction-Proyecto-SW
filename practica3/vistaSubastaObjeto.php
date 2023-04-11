<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/subastas/ListadoSubastas.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal='';
<<<<<<< HEAD
$contenido='ventas';

$contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar($contenido);



if ($app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::USER_ROLE)||$app->tieneRol(es\ucm\fdi\aw\usuarios\Usuario::BUSSINES_ROLE)) {
    
  


 
} else {
  $contenidoPrincipal=<<<EOS
    <h1>Usuario no registrado!</h1>
    <p>Debes iniciar sesión para ver el contenido.</p>
    
  EOS;
}

=======
$contenido='busquedaTitulo';
$busquedaTitulo= $_GET["barra"];
$categoria= $_GET["categoria"];

if($categoria!=""){
  $contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar('categoria',$categoria);

}else{
$contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar('busquedaTitulo',$busquedaTitulo);
}




>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaInicio.php', $params);