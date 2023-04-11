<?php

<<<<<<< HEAD
<<<<<<< HEAD
use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\usuarios\FormularioLogout;
=======
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f


use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\usuarios\FormularioLogout;
$app = Aplicacion::getInstance();
<<<<<<< HEAD
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f

function mostrarSaludo()
{
    $html = '';
<<<<<<< HEAD
=======
	$busqueda= '';
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
    $app = Aplicacion::getInstance();
    if ($app->usuarioLogueado()) {
        $nombreUsuario = $app->nombreUsuario();

        $formLogout = new FormularioLogout();
        $htmlLogout = $formLogout->gestiona();
<<<<<<< HEAD
        $html = "Bienvenido, ${nombreUsuario}. $htmlLogout";
=======
        $html = "Bienvenido, ${nombreUsuario}.$htmlLogout";
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
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
<<<<<<< HEAD
<<<<<<< HEAD
<header>
    <h1>Mi gran página web</h1>
    <div class="saludo">
        <?= mostrarSaludo(); ?>
    </div>
</header>
=======

<html>
<head><title>Cabecera</title></head>
<body>

<header class="CabeceraPrincipal">
<?php echo mostrarSaludo(); ?>
	<div class="CabeceraSuperior">		
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
        <a href="ruta_notificaciones"><img src="\sw\practica2\includes\vistas\imagenes\campana.png" width="20"></img></a>
        <a href="ruta o despegable_de_carrito"><img src="\sw\practica2\includes\vistas\imagenes\carrito.png" width="20"></img></a>		
        <li><a href="<?= $app->resuelve('/contenidomiperfil.php?ventas=ventas')?>">mi perfil</a></li> 
	</div>

    <div class="CabeceraInferior">		
		<div class="Imagen">			
		<img src="\sw\practica2\includes\vistas\imagenes\logoTikTak.jpeg" width="50"><p>Tik Tak auction</p>
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
    <a href="<?= $app->resuelve('/vistaSubastaObjeto.php')?>"><button type="button">buscar</button></a>
		</form>
		</div>
    </div>
</header>
</body>
</html>
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======

<html>
  
  <body>
    <header class="CabeceraPrincipal">
      <div class="CabeceraSuperior">
        <div class="LoginLinks">
		<?php echo mostrarSaludo(); ?>
        </div>
        <div class="PerfilLinks">
          <a href="<?= $app->resuelve('/contenidomiperfil.php?ventas=ventas')?>">Mi perfil</a>
          <a href="ruta_notificaciones"><img src="\sw\practica2\includes\vistas\imagenes\campana.png" width="20"></a>
          <a href="ruta o despegable_de_carrito"><img src="\sw\practica2\includes\vistas\imagenes\carrito.png" width="20"></a>
        </div>
      </div>
   
      <div class="CabeceraInferior">
        <div class="Imagen">
		<a href="index.php"><img src= <?php echo RUTA_IMGS.'\logoTikTak.jpeg'; ?>	 alt="Logo TikTak"></a>
          
        </div>
        <div class="BarraBusq">
          <form action="<?= $app->resuelve('/vistaSubastaObjeto.php')?>"  method="get">
            <div class="BarraBusqContent">
              <div class="barra">
				<input type="text" name="barra" id="barra"  placeholder="Buscar cualquier artículo">
              <select name="categoria" id="categoria">
                <option value="">Buscar Categoría</option>
                <option value="opcion1">Opción 1</option>
                <option value="opcion2">Opción 2</option>
                <option value="opcion3">Opción 3</option>
                <option value="opcion4">Opción 4</option>
                <option value="opcion5">Opción 5</option>
              </select>
			  </div>
			  <div class="boton"><input type="submit" value="Buscar"></div>
		</div>
          </form>
        </div>
      </div>
	  
    </header>
  </body>
</html>
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
