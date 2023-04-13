<?php
use es\ucm\fdi\aw\Aplicacion;

$app = Aplicacion::getInstance();
?>
<nav id="sidebarIzqSubastas">
	<select>
		<option value="">Categoría</option>
		<option value="opcion1">Opción 1</option>
		<option value="opcion2">Opción 2</option>
		<option value="opcion3">Opción 3</option>
	</select>
	<select>
		<option value="">Subopciones</option>
		<option value="subopcion1">Subopción 1</option>
		<option value="subopcion2">Subopción 2</option>
	</select>
	<select>
		<option value="">Estado</option>
		<option value="nuevo">Nuevo</option>
		<option value="poco_usado">Poco usado</option>
		<option value="usado">Usado</option>
		<option value="desgastado">Desgastado</option>
	</select>

	<div>
		<label for="min">Mín</label>
		<input type="precioMinimo" step="0.01" id="min" name="min" placeholder="Mín €">
		<span>€</span>
	</div>
	<div>
		<label for="max">Max</label>
		<input type="precioMaximo" step="0.01" id="max" name="max" placeholder="Max €">
		<span>€</span>
	</div>
</nav>
