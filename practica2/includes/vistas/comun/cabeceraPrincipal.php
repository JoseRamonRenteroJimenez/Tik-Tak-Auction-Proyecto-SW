<?php use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\usuarios\FormularioLogout;
$app = Aplicacion::getInstance();

function mostrarSaludo()
{
    $html = '';
    $app = Aplicacion::getInstance();
    if ($app->usuarioLogueado()) {
        $nombreUsuario = $app->nombreUsuario();

        $formLogout = new FormularioLogout();
        $htmlLogout = $formLogout->gestiona();
        $html = "Bienvenido, ${nombreUsuario}. $htmlLogout";
    } else {
        $loginUrl = $app->resuelve('/login.php');
        $registroUrl = $app->resuelve('/registro.php');
        $html = <<<EOS
        Usuario desconocido. <a href="{$loginUrl}">Login</a> <a href="{$registroUrl}">Registro</a>
      EOS;
    }

    return $html;
}

?>


<html>
<head><title>Cabecera</title></head>
<body>

<header class="CabeceraPrincipal">
	<div class="CabeceraSuperior">	
	<!-- Aqui llamariamos a la funcion mostrar saludo-->
	<!-- Hacer que justo esto de abajo se muestre solo cuando estas registrado-->
	<select>
			  <option value="">Mi tik tak</option>
			  <optgroup label="Opciones principales">
				<option value="opcion1">Opción 1</option>
				<option value="opcion2">Opción 2</option>
				<option value="opcion3">Opción 3</option>
			  </optgroup>
			  <optgroup label="Opciones secundarias">
				<option value="opcion4">Opción 4</option>
				<option value="opcion5">Opción 5</option>
			  </optgroup>
		</select> 
        <a href="ruta_notificaciones"><img src="\Archivos_GIT\practica2\includes\vistas\imagenes\campana.png" width="20"></img></a>
        <a href="ruta o despegable_de_carrito"><img src="\Archivos_GIT\practica2\includes\vistas\imagenes\carrito.png" width="20"></img></a>		
	</div>

    <div class="CabeceraInferior">		
		<div class="Imagen">			
		<img src="\Archivos_GIT\practica2\includes\vistas\imagenes\logotiktak.jpg" width="50"><p>Tik Tak auction</p>
		</div>
		<div class="BarraBusq">
		<form action="/search" method="post">
		  <input type="text" name="barra" placeholder="Buscar cualquier artículo">
		  <select>
			  <option value="">Buscar Categoría</option>
			  <optgroup label="Opciones principales">
				<option value="opcion1">Opción 1</option>
				<option value="opcion2">Opción 2</option>
				<option value="opcion3">Opción 3</option>
			  </optgroup>
			  <optgroup label="Opciones secundarias">
				<option value="opcion4">Opción 4</option>
				<option value="opcion5">Opción 5</option>
			  </optgroup>
		</select>  
		  <button type="submit">Buscar</button>
		</form>
		</div>
    </div>
</header>
</body>
</html>