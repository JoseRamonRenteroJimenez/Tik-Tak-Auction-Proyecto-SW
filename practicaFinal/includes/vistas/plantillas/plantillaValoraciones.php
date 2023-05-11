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
    <script type="text/javascript" src="<?= $params['app']->resuelve('js/jquery-3.6.0.min.js')?>"></script>
	<script type="text/javascript" src="<?= $params['app']->resuelve('js/valoracion.js') ?>"></script>
<body>
<?= $mensajes ?>
<div id="contenedor">
<?php
$params['app']->doInclude('/vistas/comun/cabecera.php');
$params['app']->doInclude('/vistas/comun/sidebarIzq.php');
?>
	<main>
		<article>
			<?= $params['contenidoPrincipal'] ?>
		</article>
	</main>
<?php
$params['app']->doInclude('/vistas/comun/sidebarDer.php');
$params['app']->doInclude('/vistas/comun/pie.php');
?>
</div>
</body>
</html>
