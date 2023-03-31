<?php
namespace es\ucm\fdi\aw\subastas;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;


class hacerPuja extends Formulario
{
    public function __construct() {     
        parent::__construct('formObjeto', ['urlRedireccion']);
  
    }
    
    public function generaCamposFormulario(&$datos)
    {
        $idpuja=$_POST["idsubasta"];
        $resultadoTablaSubastas = ListadoSubastas::listadoUnicaSubasta($idpuja);
        //Creamos aqui la parte fija del codigo HTML
        $html = <<<EOF
        <fieldset>
            <legend>Subastas actuales</legend>
            $resultadoTablaSubastas      
        </fieldset>
    EOF;
    return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
       $app=Aplicacion::getInstance();
            $idSubasta = $_POST['idsubasta'];
            $nuevoprecio=$_POST['nuevoprecio'];
            $subasta = Subasta::buscaPorId($idSubasta);
            $idganador=$app->idUsuario();
            if($subasta) {
                $subasta = Subasta::actualizaSubasta($idSubasta,$subasta->getIdUsuario(), $subasta->getTitulo(), $subasta->getDescripcion(), $subasta->getFechaInicio(), $subasta->getFechaFin(), $subasta->getPrecioInicial(), $nuevoprecio,$subasta->getImagen(), $subasta->getCategoria(), $subasta->getEstadoProducto(),$idganador);
                echo "<p>Subasta borrada correctamente.</p>";
            } else {
                echo "<p>No se ha encontrado la subasta que se quiere borrar.</p>";
            }
        
    }
}
?>