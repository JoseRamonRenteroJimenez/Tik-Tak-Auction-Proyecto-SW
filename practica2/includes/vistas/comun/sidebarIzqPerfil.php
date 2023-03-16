<?php
use es\ucm\fdi\aw\Aplicacion;

$app = Aplicacion::getInstance();
?>
<nav id="sidebarIzqPerfil">
	<h3>Navegación</h3>
	<ul>
		<li><a href="<?= $app->resuelve('/resumenPerfil.php')?>">Resumen</a></li>
		<li><a href="<?= $app->resuelve('/comprasPerfil.php')?>">Compras</a></li>
		<li><a href="<?= $app->resuelve('/guardadosPerfil.php')?>">Guardados</a></li>
        <li><a href="<?= $app->resuelve('/ventasPerfil.php')?>">Ventas</a>
		<ul>
		<li><a href="<?= $app->resuelve('/ventasPerfil.php')?>">Vista general</a></li>
		<li><a href="<?= $app->resuelve('/ventasPerfil.php')?>">Borradores</a></li>
		<li><a href="<?= $app->resuelve('/ventasPerfil.php')?>">Programados</a></li>
		<li><a href="<?= $app->resuelve('/ventasPerfil.php')?>">Activos</a></li>
		<li><a href="<?= $app->resuelve('/ventasPerfil.php')?>">Vendidos</a></li>
		</ul>
	</li>
		
	</ul>
</nav>
