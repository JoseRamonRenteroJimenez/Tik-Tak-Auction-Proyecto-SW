<?php



use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\usuarios\FormularioLogout;
$app = Aplicacion::getInstance();

function mostrarSaludo()
{
    $html = '';
	$busqueda= '';
    $app = Aplicacion::getInstance();
    if ($_SERVER['PHP_SELF'] == '/registro.php') {
      $titulo = 'Página de inicio';
  } elseif ($_SERVER['PHP_SELF'] == '/login.php') {
      $titulo = 'Acerca de nosotros';
  }
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
<?php echo mostrarSaludo(); ?>
	<div class="CabeceraSuperior">		
	
        

	</div>

    <div class="CabeceraInferior">		
		<div class="Imagen">			
		<img src="\sw\practica2\includes\vistas\imagenes\logoTikTak.jpeg" width="50"><p>Tik Tak auction</p>
		</div>
		
    </div>
</header>
</body>
</html>