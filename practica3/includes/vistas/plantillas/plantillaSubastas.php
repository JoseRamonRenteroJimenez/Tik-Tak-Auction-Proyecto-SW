<?php
$params['app']->doInclude('/vistas/helpers/plantilla.php');
$mensajes = mensajesPeticionAnterior();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $params['tituloPagina'] ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve('/css/estilo.css') ?>" /></head>
<body>
<?= $mensajes ?>
<div id="contenedorperfilusuario">
<?php
$params['app']->doInclude('/vistas/comun/cabecera.php');
//$params['app']->doInclude('/vistas/comun/sidebarIzqPerfil.php');
?>
	<main>
		<article>
		<?= $params['app']->doInclude('/vistas/comun/cabeceraPerfilusuario.php') ?>
		<?= $params['app']->doInclude('/vistas/comun/sidebarIzqSubastas.php') ?>
		<div>
			<?= $params['contenidoPrincipal'] ?>
		</div>
		</article>
	</main>

</div>
</body>
<?php
$params['app']->doInclude('/vistas/comun/pie.php');
?>
</html>