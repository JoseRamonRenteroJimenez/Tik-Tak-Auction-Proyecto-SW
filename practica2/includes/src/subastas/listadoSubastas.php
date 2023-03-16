<?php
namespace es\ucm\fdi\aw\subastas;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;

class ListadoSubastas extends Formulario
{
    public function __construct() {
        parent::__construct('formObjeto', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/index.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
       
        $tipo = $datos['TipoSubasta'] ?? '';
        $estado = $datos['Estado'] ?? '';
        $relevancia = $datos['Relevancia'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['TipoSubasta', 'Estado', 'Relevancia'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        //Creamos aqui la parte fija del codigo HTML
        <form method="post">
            <p>Todas</p>
            <select name="TipoSubasta" value="$tipo">
                <option>Tipo de subasta</option>
                <optgroup>
                    <option>opcion1</option>
                </optgroup>
            </select>
            $erroresCampos[TipoSubasta]
            <select name="Estado" value="$estado">
                <option>Estado</option>
                <optgroup>
                    <option>opcion1</option>
                </optgroup>
            </select>
            $erroresCampos[Estado]
            <p>Ordenar</p>
            <select name="Relevancia" value="$relevancia">
                <option>Relevancia</option>
                <optgroup>
                    <option>opcion1</option>
                </optgroup>
            </select>
            $erroresCampos[Relevancia]
        </form>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
       
        $tipo = $datos['TipoSubasta'] ?? '';
        $estado = $datos['Estado'] ?? '';
        $relevancia = $datos['Relevancia'] ?? '';



        $app = Aplicacion::getInstance();
        $idUsuario = $app->idUsuario();
        
      
        $subastas = array(); // Declarar $subastas como un array vacío
        $resultados = Subasta::buscaSubasta("");
        echo ($resultados.getEstado());
        // Agregar cada objeto Subasta devuelto por el método al array $subastas
        foreach ($resultados as $fila) {
            $subasta = new Subasta($fila['id_usuario'], $fila['titulo'], $fila['descripcion'], $fila['fecha_inicio'], $fila['fecha_fin'], $fila['precio_inicial'], $fila['precio_actual'], $fila['imagen'], $fila['categoria'], $fila['estadoproducto'], $fila['id_subasta'], $fila['id_ganador'], $fila['estado']);
            array_push($subastas, $subasta); // o también: $subastas[] = $subasta;
        }
        echo "<table>";
        echo "<tr><th>ID</th><th>Titulo</th><th>Descripcion</th><th>Fecha de inicio</th><th>Fecha de fin</th><th>Precio inicial</th><th>Precio actual</th><th>ID ganador</th><th>Estado</th><th>Imagen</th><th>Categoria</th></tr>";
        foreach ($subastas as $subasta) {
            echo "<tr>";
            echo "<td>" . $subasta->getIdSubasta() . "</td>";
            echo "<td>" . $subasta->getTitulo() . "</td>";
            echo "<td>" . $subasta->getDescripcion() . "</td>";
            echo "<td>" . $subasta->getFechaInicio() . "</td>";
            echo "<td>" . $subasta->getFechaFin() . "</td>";
            echo "<td>" . $subasta->getPrecioInicial() . "</td>";
            echo "<td>" . $subasta->getPrecioActual() . "</td>";
            echo "<td>" . $subasta->getIdGanador() . "</td>";
            echo "<td>" . $subasta->getEstado() . "</td>";
            echo "<td>" . $subasta->getImagen() . "</td>";
            echo "<td>" . $subasta->getCategoria() . "</td>";
            echo "</tr>";
        }
        echo "</table>";      
    }
}

function listasubastas()
{
    $subasta = Subasta::buscaSubasta("e");
    /*if (count($subasta) == 0) {
        return '';
    }*/

    $html = '<ul>';
   //foreach($subasta as $subasta) {
        $html .= '<li>';
        $html .= visualizaSubasta($subasta);
      // echo($subasta);
        
        $html .= '</li>';
  // }
    $html .= '</ul>';

    return $html;
}
function visualizaSubasta($subasta)
{
    /*$verURL = Utils::buildUrl('mensajes/mensajes.php', [
        'id' => $subasta->id
    ]);*/
    //echo($subasta);
    // echo($subasta->id_usuario.",".$subasta->titulo .",".$subasta->descripcion .",".$subasta->fecha_inicio.",". $subasta->fecha_fin .",".$subasta->precio_inicial.",". $subasta->precio_actual.",". $subasta->id_ganador .",".$subasta->estado .",".$subasta->imagen .",".$subasta->categoria.",". $subasta->estadoproducto.",". $subasta->obtenerEstadoSubasta($subasta->fecha_inicio,$subasta->fecha_fin));

    
    
    return <<<EOS
            <p>$subasta->descripcion $subasta->titulo </p>
    EOS;
}
?>