<?php



use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\usuarios\FormularioLogout;
$app = Aplicacion::getInstance();

function mostrarSaludo()
{
    $html = '';
	$busqueda= '';
    $app = Aplicacion::getInstance();
    if ($app->usuarioLogueado()) {
        $nombreUsuario = $app->nombreUsuario();

        $formLogout = new FormularioLogout();
        $htmlLogout = $formLogout->gestiona();
        $html = "Bienvenido, ${nombreUsuario}.$htmlLogout";
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
		<a href="index.php">	<img src= <?php echo RUTA_IMGS.'\logoTikTak.jpeg'; ?>	 alt="Logo TikTak"></a>
          
        </div>
        <div class="BarraBusq">
          <form action="<?= $app->resuelve('/vistaSubastaObjeto.php')?>"  method="get">
            <div class="BarraBusqContent">
              <input type="text" name="barra" id="barra"  placeholder="Buscar cualquier artículo">
              <select name="categoria" id="categoria">
                <option value="">Buscar Categoría</option>
                <option value="opcion1">Opción 1</option>
                <option value="opcion2">Opción 2</option>
                <option value="opcion3">Opción 3</option>
                <option value="opcion4">Opción 4</option>
                <option value="opcion5">Opción 5</option>
              </select>
            <input type="submit" value="Buscar">
		</div>
          </form>
        </div>
      </div>
	  
    </header>
  </body>
</html>