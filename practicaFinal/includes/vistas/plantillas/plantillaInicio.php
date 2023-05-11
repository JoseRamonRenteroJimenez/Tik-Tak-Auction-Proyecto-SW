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
	<script type="text/javascript" src="<?= $params['app']->resuelve('/js/inicio.js') ?>"></script>
	<script type="text/javascript" src="<?= $params['app']->resuelve('configjs.php') ?>"></script>
	
	<!-- Importamos framework Font Awesome para que se vean las estrellas-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<body>
<?= $mensajes ?>
<div id="contenedorinicio">
<?php
$params['app']->doInclude('/vistas/comun/cabecera.php');
?>
	<main>
        
		<article>
			<?= $params['contenidoPrincipal'] ?>
		</article>
	</main>
<?php
$params['app']->doInclude('/vistas/comun/pie.php');
?>
</div>
</body>
<script type="text/javascript" src="<?= $params['app']->resuelve('/js/contador.js') ?>"></script>
</html>
