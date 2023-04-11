<?php
namespace es\ucm\fdi\aw\usuarios;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;

class FormularioLogin extends Formulario
{
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/index.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario = $datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'password'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
<<<<<<< HEAD
        <fieldset>
            <legend>Usuario y contraseña</legend>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario" />
                {$erroresCampos['nombreUsuario']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
=======
        <div class="center">
            <h1>Hola</h1>
            <h4>Identifícate en tiktak o <a href="registro.php" value="registrate">registate</a></h4>
            <div class="txt_field">
          
                <span class="logreg"><input id="nombreUsuario" type="text" placeholder="Nombre de usuario" name="nombreUsuario" value="$nombreUsuario" /></span>
                {$erroresCampos['nombreUsuario']}
            </div>
            <div class="txt_field">
             
                <input id="password" type="password" placeholder="Password" name="password" />
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
                {$erroresCampos['password']}
            </div>
            <div>
                <button type="submit" name="login">Entrar</button>
<<<<<<< HEAD
            </div>
        </fieldset>
=======
                <input id="conectado" name="conectado" type="checkbox" value="conectado" checked/> 
                <label for="conectado"> Seguir conectado</label>
            </div>
        </div>
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $nombreUsuario = trim($datos['nombreUsuario'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || empty($nombreUsuario) ) {
            $this->errores['nombreUsuario'] = 'El nombre de usuario no puede estar vacío';
        }
        
        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password) ) {
            $this->errores['password'] = 'El password no puede estar vacío.';
        }
        
        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
        
            if (!$usuario) {
                $this->errores[] = "El usuario o el password no coinciden";
            } else {
                $app = Aplicacion::getInstance();
                $app->login($usuario);
            }
        }
    }
}
