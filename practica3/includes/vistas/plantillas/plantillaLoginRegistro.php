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
<div id="contenedorinicio">
<<<<<<< HEAD
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
=======
	<?= $params['app']->doInclude('/vistas/comun/cabeceraLoginRegistro.php') ?>

	<main>
	
		<article>
		<?= $params['contenidoPrincipal'] ?>
		</article>
	</main>

>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
</div>
</body>
</html>