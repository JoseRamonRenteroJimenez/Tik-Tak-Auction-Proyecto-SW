<?php

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'localhost');
<<<<<<< HEAD
define('BD_NAME', 'aw');
define('BD_USER', 'aw');
define('BD_PASS', 'aw');
=======
define('BD_NAME', 'practica2');
define('BD_USER', 'practica2');
define('BD_PASS', 'practica2');

>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3

/**
 * Parámetros de configuración utilizados para generar las URLs y las rutas a ficheros en la aplicación
 */
define('RAIZ_APP', __DIR__);
<<<<<<< HEAD
define('RUTA_APP', '/estructura-proyecto');
=======
define('RUTA_APP', '/sw/practica2/');
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
define('RUTA_IMGS', RUTA_APP.'img/');
define('RUTA_CSS', RUTA_APP.'css/');
define('RUTA_JS', RUTA_APP.'js/');

<<<<<<< HEAD
=======


 // Parámetros de conexión a la BD produccion
 /*
define('BD_HOST', 'vm16.db.swarm.test');
define('BD_NAME', 'practica2');
define('BD_USER', 'practica2');
define('BD_PASS', 'practica2');
*/

//Parámetros de configuración utilizados para generar las URLs y las rutas a ficheros en la aplicación produccion
/*
define('RAIZ_APP', __DIR__);
define('RUTA_APP', '');
define('RUTA_IMGS', RUTA_APP.'img/');
define('RUTA_CSS', RUTA_APP.'css/');
define('RUTA_JS', RUTA_APP.'js/');
*/

>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

/**
 * Función para autocargar clases PHP.
 *
 * @see http://www.php-fig.org/psr/psr-4/
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'es\\ucm\\fdi\\aw\\';

    // base directory for the namespace prefix
    $base_dir = implode(DIRECTORY_SEPARATOR, [__DIR__, 'src', '']);

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/* */
/* Inicialización de la aplicación */
/* */

<<<<<<< HEAD
define('INSTALADA', false);
=======
define('INSTALADA', true);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3

$app = \es\ucm\fdi\aw\Aplicacion::getInstance();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS), RUTA_APP, RAIZ_APP);

<<<<<<< HEAD
if (! INSTALADA) {
=======

if (!INSTALADA) {
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
	$app->paginaError(502, 'Error', 'Oops', 'La aplicación no está configurada. Tienes que modificar el fichero config.php');
}

/**
 * @see http://php.net/manual/en/function.register-shutdown-function.php
 * @see http://php.net/manual/en/language.types.callable.php
 */
register_shutdown_function(array($app, 'shutdown'));
