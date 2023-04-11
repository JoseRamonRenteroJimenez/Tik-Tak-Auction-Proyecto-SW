<?php
namespace es\ucm\fdi\aw\valoraciones;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;

class FormularioValoraciones extends Formulario
{
    const EXTENSIONES_PERMITIDAS = array('gif', 'jpg', 'jpe', 'jpeg', 'png', 'webp', 'avif');
    const TIPO_ALMACEN = [Imagen::PUBLICA => 'Publico', Imagen::PRIVADA =>'Privado'];

    public function __construct() {
        parent::__construct('formObjeto', ['enctype' => 'multipart/form-data', 'urlRedireccion' => Aplicacion::getInstance()->resuelve('/index.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
       
        $idvaloracion= '';
        $idsubasta= '';
        $tituloproducto= '';

        $puntuacion = $datos['puntuacion'] ?? '';
        $comentario = $datos['comentario'] ?? '';

        $idvendedor = $datos['idvendedor'] ?? '';

        if(isset($_POST['idsubasta'])){
            $idvaloracion= $_POST['idvaloracion'];
            $idSubasta= $_POST['idsubasta'];
            $idvendedor= $_POST['idvendedor'];
            
            $valoracion = Valoracion::buscaPorId($idvaloracion);
            $puntuacion = $valoracion->getPuntuacion();
            $comentario =$valoracion->getComentario();          
       }


        // Se generan los mensajes de error si existen.
        
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['comentario'], $this->errores, 'span', array('class' => 'error'));
       
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Evaluacion de vendedor</legend>
            <input type="hidden" name="idvaloracion" value="$idvaloracion" />
            <input type="hidden" name="idSubasta" value="$idSubasta" />
            <input type="hidden" name="tituloproducto" value="$tituloproducto" />
            <div >
                <label>Vendedor:</label> <input type="text" name="idvendedor" value="$idvendedor" />
            </div>
            <div >
                <label>Producto:</label> <input type="text" name="tituloproducto">$tituloproducto</textarea>
            </div>
            <div >
                <label>Evalua al vendedor:</label> <input type="number" name="puntuacion" value="$puntuacion" />
            </div>
            <div >
                <label>Descripción:</label> <textarea name="comentario">$comentario</textarea>
                $erroresCampos[comentario]
            </div>           
            <div >
                <button type="submit" name="valoracion">Enviar evaluación
            <div>

        </fieldset>
        EOF;
        return $html;
    }   

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $comentario = trim($datos['comentario'] ?? '');
        $comentario = filter_var($comentario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $idvaloracion =trim($datos['idvaloracion'] ?? '');  
        $idvaloracion = filter_var($idvaloracion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $idSubasta = trim($datos['idSubasta'] ?? '');
        $idSubasta = filter_var($idSubasta, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $tituloproducto = trim($datos['tituloproducto'] ?? '');
        $tituloproducto = filter_var($tituloproducto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $idvendedor = trim($datos['idvendedor'] ?? '');
        $idvendedor = filter_var($idvendedor, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $puntuacion= trim($datos['puntuacion'] ?? '');
        $puntuacion = filter_var($puntuacion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (count($this->errores) === 0) {
          //  $subasta = Subasta::buscaSubasta($tituloSubasta);
	
                $app = Aplicacion::getInstance();
                $idUsuario = $app->idUsuario();
              if($idvaloracion!=""){
                $valoracion = Valoracion::actualizaValoracion($idvaloracion,$idusuario, $idsubasta, $tituloproducto, $puntuacion, $comentario,$idvendedor);  

              }else{
                $valoracion = Valoracion::crea($idusuario, $idsubasta, $tituloproducto, $puntuacion, $comentario,$idvendedor);               
         }
                
        }
    }
}