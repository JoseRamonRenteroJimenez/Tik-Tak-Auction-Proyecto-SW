<?php
namespace es\ucm\fdi\aw\subastas;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;


class HacerPuja extends Formulario
{
    public function __construct() {     
        parent::__construct('formPuja', ['urlRedireccion']);
  
    }
    
    public function generaCamposFormulario(&$datos)
    {
        $idpuja=$_GET["idsubasta"];
        $app = Aplicacion::getInstance();
        $subasta = Subasta::buscaPorId($idpuja);
        /*$resultadoTablaSubastas = ListadoSubastas::listadoUnicaSubasta($idpuja);*/
        //Creamos aqui la parte fija del codigo HTML
           
        
    if ($app->tieneRol(\es\ucm\fdi\aw\usuarios\Usuario::USER_ROLE)||$app->tieneRol(\es\ucm\fdi\aw\usuarios\Usuario::BUSSINES_ROLE)) {
        $html = "";
         if ($subasta->getTipoSubasta()=="Holandesa"){
            $html .= <<<EOF
            <input type="hidden" name="nuevoprecio" value="{$subasta->getPrecioActual()}">    
            <input type="hidden" name="idsubasta" value="{$subasta->getIdSubasta()}">
            <input type="hidden" name="refresco" value="true">
            <button type="submit" id="bid-button">Comprar</button>
       
            
             
     EOF;    
         } else if($subasta->getTipoSubasta()=="ReservaCiega"){   
            $html .= <<<EOF
                    
                    
                      
            <input type="text" name="nuevoprecio" id="bid-amount" value="{$subasta->getPrecioInicial()}"></input>
            <input type="hidden" name="idsubasta" value="{$subasta->getIdSubasta()}">
            <input type="hidden" name="refresco" value="true">
            <p>Puja Mínima: {$subasta->getPrecioInicial()}</p>
            <button type="submit" id="bid-button">Pujar</button>
       
            
             
     EOF;    
            
          } else{
            $html .= <<<EOF
                    
                    
                      
                    <input type="text" name="nuevoprecio" id="bid-amount" value="{$subasta->getPrecioActual()}"></input>
                    <input type="hidden" name="idsubasta" value="{$subasta->getIdSubasta()}">
                    <input type="hidden" name="refresco" value="true">
                    <p>Puja Mínima: {$subasta->getPrecioActual()}</p>
                    <button type="submit" id="bid-button">Pujar</button>
               
                    
                     
             EOF;    
            }   
                    
                    } else {
                        $loginUrl = $app->resuelve('/login.php');
                        $registroUrl = $app->resuelve('/registro.php');
                        $html = <<<EOF
                         <td> <a href="{$loginUrl}">Login</a> <a href="{$registroUrl}">Registro</a></td> 
                      EOF;
                    }
    return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
       $app=Aplicacion::getInstance();
            $idSubasta = $datos['idsubasta'];
            $nuevoprecio=$datos['nuevoprecio'];
         
            $subasta = Subasta::buscaPorId($idSubasta);
            $idganador=$app->idUsuario();
            if($subasta) {
                $subasta = Subasta::actualizaSubasta($idSubasta,$subasta->getIdUsuario(), $subasta->getTitulo(), $subasta->getDescripcion(), $subasta->getFechaInicio(), $subasta->getFechaFin(), $subasta->getPrecioInicial(), $nuevoprecio, $subasta->getCategoria(), $subasta->getEstadoProducto(),$idganador);
               
            } else {
                echo "<p>Error al hacer la puja</p>";
            }
        
    }
}
?>