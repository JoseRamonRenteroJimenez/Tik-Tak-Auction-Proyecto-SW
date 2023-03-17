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
<div id="contenedor">
<?php
$params['app']->doInclude('/vistas/comun/cabeceraPerfilUsuario.php');
//$params['app']->doInclude('/vistas/comun/sidebarIzq.php');
?>

<div id="inputName">

<label for="lname">Titulo del anuncio:</label>
<input type="text" id="lname" name="lname">

</div>

<div id="addFoto">

  <label>Añadir una foto
  <input type="file" name="imagen">
  </label>
  <input type="submit" value="Subir foto">

</div>

<div id="addDescripcion">

  <label>Añadir una descripción
  </label>
  <input type="submit" value="Descipción">

</div>

<div id="precio">

  <label for="precio">Puja inicial</label>
  <input type="number" id="quantity" min="0" max="999">
  <input type="submit" value="€">

  <select name="tipoSubasta" id="tipoSubasta">
      <option>Normal</option>
      <option>Inglesa</option>
      <option>Holandesa</option>
      <option>Española</option>
    </select>

</div>

<div id="selectFecha">

  <label for="publicacion">Publicación</label>
  <input type="radio" value="Inmediato">
  <label for="inm">Inmediato</label>
  <input type="radio" value="Programado">
  <label for="pro">Programado</label>
  <label for="date">Fecha de publicación:</label>
  <input type="date" id="fecha">

</div>

<div id="botons">

<input type="button" value="Publicar"> 
<input type="button" value="Borrador"> 

</div>

</body>
</html>