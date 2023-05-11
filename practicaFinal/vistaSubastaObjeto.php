<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/subastas/ListadoSubastas.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal='';
$contenido='busquedaTitulo';
$busquedaTitulo= isset($_GET['barra']) ? $_GET['barra'] : '';
$categoria= isset($_GET['categoria']) ? $_GET['categoria'] : '';
$vendedorId = isset($_GET['vendedor']) ? $_GET['vendedor'] : '';

if($categoria!=""){
  $contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar('categoria',$categoria);

}else if($vendedorId!=""){
  $contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar('busquedaVendedor',$vendedorId);
}
else{
$contenidoPrincipal = \es\ucm\fdi\aw\subastas\ListadoSubastas::listadoPujar('busquedaTitulo',$busquedaTitulo);
}




$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaInicio.php', $params);