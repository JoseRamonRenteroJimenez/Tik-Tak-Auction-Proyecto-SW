<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/subastas/ListadoSubastas.php';

$tituloPagina = 'Subastas';
$contenidoPrincipal='';
$contenido='busquedaTitulo';
$busquedaTitulo= $_GET["barra"];
$categoria= $_GET["categoria"];

if($categoria!=""){
  $contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar('categoria',$categoria);

}else{
  $contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar('busquedaTitulo',$busquedaTitulo);
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaSubastas.php', $params);